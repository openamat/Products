<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TripAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'trips');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('trips');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'trips/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'trips', $this->trip->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('trips/'.$this->trip->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'trips', $this->trip->toArray());

        $response = $this->actor->call('GET', '/trips/'.$this->trip->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('trip');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'trips', $this->trip->toArray());
        $response = $this->actor->call('PATCH', 'trips/1', $this->tripEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('trips', $this->tripEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'trips', $this->trip->toArray());

        $response = $this->call('DELETE', 'trips/'.$this->trip->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('trips');
    }

}
