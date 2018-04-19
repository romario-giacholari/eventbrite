<?php

namespace Tests\Feature;

use App\User;
use App\Event;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishesEventsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = Factory(User::class)->create();

        $this->withoutExceptionHandling();
    }

    public function test_an_authenticated_user_can_post_new_events()
    {
        $this->actingAs($this->user);

        $event = factory(Event::class)->make([
            'thumbnail' => UploadedFile::fake()->image('file.jpg'),
        ]);

        $this->post(route('events.store', $event));

        $this->assertTrue($this->user->events->contains($event));

    }
}
