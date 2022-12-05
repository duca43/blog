<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testGettingOfPosts()
    {
        // 1. korak (Arrange) nemamo jer nemamo testnih podataka

        // 2. korak (Act) - izvrsavamo sam test

        $response = $this->get('/posts');

        // 3. korak (Assert) - utvrdjujemo da li je test uspesan

        $response->assertOk(); // ocekujemo statusni kod 200
    }

    public function testCreatePostPage()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get('/posts/create');

        $response->assertOk();
    }

    public function testCreatePostPageWithoutAuthenticatedUser()
    {
        $response = $this->get('/posts/create');

        $response->assertRedirect('/login');
    }

    public function testCreationOfPost()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->post(
                            '/posts',
                            [
                                'title' => 'Testing post title',
                                'body' => 'Testing post body',
                            ]
                        );

        $response->assertRedirect('/posts');
    }
}
