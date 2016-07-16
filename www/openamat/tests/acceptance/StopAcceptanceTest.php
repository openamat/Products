<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StopAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->stop = factory(App\Repositories\Stop\Stop::class)->make([
            'id' => '1',
		'stop_id' => 'laravel',
		'stop_code' => 'laravel',
		'stop_name' => 'laravel',
		'stop_desc' => 'laravel',
		'stop_lat' => '1',
		'stop_lon' => '1',
		'zone_id' => '1',
		'stop_url' => 'laravel',
		'location_type' => 'laravel',
		'parent_station' => 'laravel',
		'stop_timezone' => 'laravel',
		'wheelchair_boarding' => 'laravel',

        ]);
        $this->stopEdited = factory(App\Repositories\Stop\Stop::class)->make([
            'id' => '1',
		'stop_id' => 'laravel',
		'stop_code' => 'laravel',
		'stop_name' => 'laravel',
		'stop_desc' => 'laravel',
		'stop_lat' => '1',
		'stop_lon' => '1',
		'zone_id' => '1',
		'stop_url' => 'laravel',
		'location_type' => 'laravel',
		'parent_station' => 'laravel',
		'stop_timezone' => 'laravel',
		'wheelchair_boarding' => 'laravel',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'stops');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('stops');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'stops/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'stops', $this->stop->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('stops/'.$this->stop->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'stops', $this->stop->toArray());

        $response = $this->actor->call('GET', '/stops/'.$this->stop->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('stop');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'stops', $this->stop->toArray());
        $response = $this->actor->call('PATCH', 'stops/1', $this->stopEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('stops', $this->stopEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'stops', $this->stop->toArray());

        $response = $this->call('DELETE', 'stops/'.$this->stop->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('stops');
    }

}
