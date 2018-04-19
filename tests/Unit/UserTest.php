<?php

namespace Tests\Unit;

use App\User;
use App\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_a_user_has_events()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->make();

        $user->events()->save($event);

        $this->assertTrue($user->events->contains($event));
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->events);
    }
}
