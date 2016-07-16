<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FareRuleAcceptanceApiTest extends TestCase
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
        $response = $this->actor->call('GET', 'api/v1/farerules');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/farerules', $this->farerule->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/farerules', $this->farerule->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/farerules/1', $this->fareruleEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('farerules', $this->fareruleEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/farerules', $this->farerule->toArray());
        $response = $this->call('DELETE', 'api/v1/farerules/'.$this->farerule->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'farerule was deleted']);
    }

}
