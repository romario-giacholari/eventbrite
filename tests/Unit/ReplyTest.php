<?php

namespace Tests\Unit;

use App\Event;
use App\Reply;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_reply_belongs_to_an_event()
    {
        $event = factory(Event::class)->create();

        $reply = factory(Reply::class)->make();

        $event->replies()->save($reply);

        $this->assertTrue($event->replies->contains($reply));
    }
}
