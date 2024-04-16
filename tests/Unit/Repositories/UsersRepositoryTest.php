<?php

namespace Tests\Unit\Repositories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
use Tests\TestCase;
use App\Repositories\UsersRepository;

class UsersRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $usersRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usersRepository = new UsersRepository();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateUser(){
        $userData = [
            'name' => 'NewPeter',
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $createdUser = $this->usersRepository->createUser($userData);

        $this->assertEquals($userData['email'], $createdUser->email);
    }
}
