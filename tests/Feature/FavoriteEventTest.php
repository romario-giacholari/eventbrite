<?php

namespace Tests\Feature;

use App\User;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoriteEventTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        
        $this->withoutExceptionHandling();
    }

    public function test_an_event_can_be_favorited()
    {
        $this->actingAs($this->user);

        $event = factory(Event::class)->create();

        $this->post(route('events.favorite', $event));

        $this->assertCount(1, $event->favorites);
    }

    public function test_an_event_can_be_ufavorited()
    {
        $this->actingAs($this->user);

        $event = factory(Event::class)->create();

        $this->post(route('events.favorite', $event)); // +1 like

        $this->delete(route('events.unfavorite', $event));

        $this->assertCount(0, $event->fresh()->favorites);
    }

    public function test_an_unauthenitcated_user_cannot_favorite_an_event()
    {
        $this->withExceptionHandling();

        $event = factory(Event::class)->create();

        $response = $this->post(route('events.favorite', $event));

        $response->assertStatus(302); //redirects as not authenticated
    }

    public function test_an_unauthenitcated_user_cannot_unfavorite_an_event()
    {
        $this->withExceptionHandling();

        $event = factory(Event::class)->create();

        $response = $this->delete(route('events.unfavorite', $event));

        $response->assertStatus(302); //redirects as not authenticated
    }
}
