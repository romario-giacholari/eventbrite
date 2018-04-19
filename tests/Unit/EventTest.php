<?php

namespace Tests\Unit;

use App\User;
use App\Event;
use App\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_event_belongs_to_a_user()
    {
        $user = factory(User::class)->create();

        $event = factory(Event::class)->make();

        $user->events()->save($event);

        $this->assertEquals($event->creator->name, $user->name);
    }

    public function test_an_event_has_many_photos()
    {
       $event = factory(Event::class)->create();

       $photos = factory(Photo::class,5)->make();

       $event->photos()->saveMany($photos);

       $this->assertCount(5, $event->photos);
    }
}
