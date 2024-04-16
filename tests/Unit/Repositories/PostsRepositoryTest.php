<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
use Tests\TestCase;
use App\Repositories\PostsRepository;


class PostsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $postsRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->postsRepository = new PostsRepository();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testFindPostByScoreId()
    {
        $post = Post::factory()->create([
            'score_id' => '12345',
        ]);

        $foundPost = $this->postsRepository->findById('12345');

        $this->assertEquals($post->id, $foundPost->id);
        $this->assertEquals($post->title, $foundPost->title);
    }


    public function testCreateNewPost()
    {
        $postData = [
            'title' => 'New Post',
            'link' => 'http://newpost.com',
            'points' => 100, 
            'score_id' => '67890',
            'posted_at' => '2024-04-15T13:04:34',
        ];

        $createdPost = $this->postsRepository->create($postData);

        $this->assertDatabaseHas('posts', [
            'title' => 'New Post',
            'link' => 'http://newpost.com',
            'points' => 100, 
            'posted_at' => '2024-04-15T13:04:34'
        ]);

        $this->assertEquals($postData['score_id'], $createdPost->score_id);
    }

    public function testUpdateAnExistingPostsPoints()
    {
        $post = Post::factory()->create([
            'points' => 100,
        ]);

        $updatedData = [
            'points' => 200, 
        ];

        $this->postsRepository->update($post, $updatedData);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'points' => 200,
        ]);
    }

    public function testGetDataToView()
    {
        Post::factory(3)->create([
            'is_deleted' => false,
        ]);

        $data = $this->postsRepository->getDataToView();

        $this->assertCount(3, $data);
        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('points', $data[0]);
        $this->assertArrayHasKey('link', $data[0]);
    }

    public function testDeletePost()
    {
        $post = Post::factory()->create([
            'is_deleted' => false,
        ]);

        $this->postsRepository->postDelete($post->id);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'is_deleted' => true,
        ]);
    }
}
