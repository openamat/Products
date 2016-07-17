<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TripAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->trip = factory(App\Repositories\Trip\Trip::class)->make([
            'id' => '1',
		'route_id' => 'laravel',
		'service_id' => 'laravel',
		'trip_id' => 'laravel',
		'trip_headsign' => 'laravel',
		'direction_id' => 'laravel',
		'block_id' => 'laravel',
		'shape_id' => 'laravel',

        ]);
        $this->tripEdited = factory(App\Repositories\Trip\Trip::class)->make([
            'id' => '1',
		'route_id' => 'laravel',
		'service_id' => 'laravel',
		'trip_id' => 'laravel',
		'trip_headsign' => 'laravel',
		'direction_id' => 'laravel',
		'block_id' => 'laravel',
		'shape_id' => 'laravel',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/trips');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/trips', $this->trip->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/trips', $this->trip->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/trips/1', $this->tripEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('trips', $this->tripEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/trips', $this->trip->toArray());
        $response = $this->call('DELETE', 'api/v1/trips/'.$this->trip->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'trip was deleted']);
    }

}
