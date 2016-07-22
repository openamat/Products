<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FareRuleAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->farerule = factory(App\Repositories\FareRule\FareRule::class)->make([
            'id' => '1',
		'fare_id' => '1',
		'route_id' => '1',
		'origin_id' => '1',
		'destination_id' => '1',
		'contains_id' => '1',

        ]);
        $this->fareruleEdited = factory(App\Repositories\FareRule\FareRule::class)->make([
            'id' => '1',
		'fare_id' => '1',
		'route_id' => '1',
		'origin_id' => '1',
		'destination_id' => '1',
		'contains_id' => '1',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'farerules');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('farerules');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'farerules/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'farerules', $this->farerule->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('farerules/'.$this->farerule->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'farerules', $this->farerule->toArray());

        $response = $this->actor->call('GET', '/farerules/'.$this->farerule->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('farerule');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'farerules', $this->farerule->toArray());
        $response = $this->actor->call('PATCH', 'farerules/1', $this->fareruleEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('farerules', $this->fareruleEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'farerules', $this->farerule->toArray());

        $response = $this->call('DELETE', 'farerules/'.$this->farerule->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('farerules');
    }

}
