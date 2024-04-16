<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Repositories\PostsRepository;

class scraperService
{
    protected $repository;

    public function __construct(PostsRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function scrapeNews()
    {
        $baseUrl = 'https://news.ycombinator.com/news?p=';
        $client = new Client();

        $newsArray = [];
        $page = 1;

        try {
            while (true) {
                $url = $baseUrl . $page;

                $response = $client->request('GET', $url);
                if ($response->getStatusCode() == 200) {
                    $html = (string) $response->getBody();

                    $crawler = new Crawler($html);

                    $content = [];

                    // filters and collects - title, link
                    $crawler->filter('.titleline > a')->each(function ($node) use(&$content) {

                        $firstLink = $node->filter('a')->first();

                        $title = $firstLink->text();           
                        $link = $firstLink->attr('href');
                        
                        $content[] = [
                            'title' => $title,
                            'link' => $link
                        ];
                    });

                    // filters and collects - points, date posted
                    $crawler->filter('td.subtext')->each(function($node, $i) use(&$content){

                        $scoreNode = $node->filter('span.score');

                        if (blank($scoreNode)) {
                            $content[$i]['points'] = null;
                            $content[$i]['score_id'] = null;                           
                            $content[$i]['posted_at'] = $node->filter('span.age')->attr('title');
                            
                        }else {
                            
                            $points = $node->filter('span.score')->text();
                            $score_id = $node->filter('span.score')->attr('id');
                            $age = $node->filter('span.age')->attr('title');
    
                            $points = explode(' ', $points)[0]; // '663 points' -> '663'
                            $age = "Date:" . str_replace('T', ' Time:', $age);

    
                            $content[$i]['points'] = $points;
                            $content[$i]['score_id'] = $score_id;                           
                            $content[$i]['posted_at'] = $age;
                        }
                    });
                    

                    // detects when all posts scraped - when page is empty 
                    if (blank($content)) {
                        break;
                    }

                    // Combines all scraped posts
                    $newsArray = array_merge($newsArray, $content);

                } else {
                    return [
                        'error' => 'Failed to retrieve the website.',
                        'code' => $response->getStatusCode()
                    ];
                }

                //  ==== TEMP =====
                // if ($page >= 1) break;

                $page++;
                sleep(1.5);
            }

        } catch (\Exception $e) {
            return [
                'error' => 'Failed to retrieve the website.',
                'code' => 'Scraping error: ' . $e->getMessage()
            ];
        }


        $newsArray = array_filter($newsArray, function($post) {
            return $post['score_id'] !== null;
        });
        return $newsArray;
    }

    public function saveNews($newsArray){
        foreach($newsArray as $post){
            $existingPost = $this->repository->findById($post['score_id']);

            if(!$existingPost){
                $this->repository->create($post);
                continue;
            }

            if(!$existingPost['is_deleted']){
                $this->repository->update($existingPost, $post);
            }
        }
        return 'Scraped successfully!';
    }

}