<?php

namespace Tests\Feature;

use App\User;
use App\Event;
use DateTime;
use Tests\TestCase;

class EventsTest extends TestCase
{

    public function testEventList()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('test@123'),
            'password_confirmation' => bcrypt('test@123')
        ]);

        $userId = User::find($user->id);

        $event = factory(Event::class)->create([
            'user_id' => $userId,
            'description' => 'description',
            'location' => 'location',
            'from_date' => new DateTime('2020-04-20T15:03:01.012345Z'),
            'to_date' => new DateTime('2020-04-20T15:03:01.012345Z')
        ]);

        $payload = array('user_id' => $userId, 'sort_option' => 'none');
        $this->json('GET', 'api/events', $payload)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'description',
                    'location',
                    'from_date',
                    'to_date',
                ],
            ]);
    }

    public function testEventCreate()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('test@123'),
            'password_confirmation' => bcrypt('test@123')
        ]);

        $userId = User::find($user->id);

        $payload = array('method' => 'create',
            'user_id' => $userId,
            'description' => 'description',
            'location' => 'location',
            'from_date' => new DateTime('2020-04-20T15:03:01.012345Z'),
            'to_date' => new DateTime('2020-04-20T15:03:01.012345Z'));

        $this->json('POST', 'api/events/update', $payload)
            ->assertJsonStructure([
                    'user_id',
                    'description',
                    'location',
                    'from_date',
                    'to_date',
                    'id',
            ]);
    }

    public function testEventUpdate()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('test@123'),
            'password_confirmation' => bcrypt('test@123')
        ]);

        $userId = User::find($user->id);

        $event = factory(Event::class)->create([
            'user_id' => $userId,
            'description' => 'description',
            'location' => 'location',
            'from_date' => new DateTime('2020-04-20T15:03:01.012345Z'),
            'to_date' => new DateTime('2020-04-20T15:03:01.012345Z')
        ]);

        $eventId = Event::find($event->id);

        $payload = array('method' => 'update',
            'user_id' => $userId,
            'event_id' => $eventId,
            'description' => 'description',
            'location' => 'location',
            'from_date' => new DateTime('2020-04-20T15:03:01.012345Z'),
            'to_date' => new DateTime('2020-04-20T15:03:01.012345Z'));

        $this->json('POST', 'api/events/update', $payload)
            ->assertJsonStructure([
                'user_id',
                'description',
                'location',
                'from_date',
                'to_date',
                'id',
            ]);
    }

    public function testEventInvalidRequest()
    {
        $this->json('POST', 'api/events/update')
            ->assertStatus(400)->assertJsonStructure(["Missing or wrong parameters"]);
    }
}
