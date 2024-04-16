<?php
namespace App\Repositories;

use App\Models\Post;

class PostsRepository
{
    public function findById($id)
    {
        return Post::where('score_id', $id)->first();
    }

    public function create($data)
    {
        return Post::create($data);
    }

    public function update(Post $scrapedData, $data)
    {
        return $scrapedData->update([
            'points' => $data['points']
        ]);
    }
    
    public function getDataToView(){
        $posts = Post::select('id', 'title', 'points', 'link', 'posted_at')->where('is_deleted', '=', false)->get();

        $scrapedData = $posts->map(function($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'points' => $post->points,
                'link' => $post->link,
                'posted_at' => $post->posted_at
            ];
        });
        return $scrapedData->toArray();
    }

    public function postDelete($id){
        $post = Post::find($id);
        
        return $post->update([
            'is_deleted' => true
        ]);
    }
}
