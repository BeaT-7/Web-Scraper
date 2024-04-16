<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\scraperService;

use function PHPSTORM_META\type;

class scrapeHackerNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scrape-hacker-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves and updates posts from hacker news';

    /**
     * Execute the console command.
     */
    public function handle(scraperService $scraperService)
    {

        $this->info("Scraping started...");
        $newsArray = $scraperService->scrapeNews();

        if (array_key_exists('error', $newsArray)){
            $this->info($newsArray['code']);
            return 1;
        }
        
        $this->info($scraperService->saveNews($newsArray));
        $scraperService->saveNews($newsArray);
    }
}
