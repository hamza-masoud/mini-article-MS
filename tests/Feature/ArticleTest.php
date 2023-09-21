<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function test_example()
//    {
//        $response = $this->get('/home/articles');
//
//        $response->assertStatus(200);
//    }

    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }

    public function tearDown(): void
    {
        $this->resetDatabase();
        parent::tearDown();
    }

    public function test_create_article()
    {
        $this->actingAs(\App\Models\User::factory()->create());
        $response = $this->post('/articles', [
            'title' => 'test',
            'content' => 'this is test message to make sure that the test is working',
        ]);

        $response->assertRedirectToRoute('articles.index');
    }

    public function test_delete_article()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $article = \App\Models\Article::factory()->create([
            'user_id' => $user->id,
        ]);
        $response = $this->delete('/articles/' . $article->slug);

        $response->assertRedirectToRoute('articles.index');
    }
}
