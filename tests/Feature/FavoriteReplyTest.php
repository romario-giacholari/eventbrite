<?php

namespace Tests\Feature;

use App\User;
use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoriteReplyTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        
        $this->withoutExceptionHandling();
    }

    public function test_a_reply_can_be_favorited()
    {
        $this->actingAs($this->user);

        $reply = factory(Reply::class)->create();

        $this->post(route('replies.favorite', $reply));

        $this->assertCount(1, $reply->favorites);
    }

    public function test_a_reply_can_be_ufavorited()
    {
        $this->actingAs($this->user);

        $reply = factory(Reply::class)->create();

        $this->post(route('replies.favorite', $reply)); // +1 like

        $this->delete(route('replies.unfavorite', $reply));

        $this->assertCount(0, $reply->fresh()->favorites);
    }

    public function test_an_unauthenitcated_user_cannot_favorite_a_reply()
    {
        $this->withExceptionHandling();

        $reply = factory(Reply::class)->create();

        $response = $this->post(route('replies.favorite', $reply));

        $response->assertStatus(302); //redirects as not authenticated
    }

    public function test_an_unauthenitcated_user_cannot_unfavorite_a_reply()
    {
        $this->withExceptionHandling();

        $reply = factory(Reply::class)->create();

        $response = $this->delete(route('replies.unfavorite', $reply));

        $response->assertStatus(302); //redirects as not authenticated
    }
}
