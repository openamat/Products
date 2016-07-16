<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FareAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->fare = factory(App\Repositories\Fare\Fare::class)->make([
            'id' => '1',
		'fare_id' => 'laravel',
		'price' => 'laravel',
		'currency_type' => 'laravel',
		'payment_method' => 'laravel',
		'transfers' => 'laravel',
		'transfer_duration' => 'laravel',

        ]);
        $this->fareEdited = factory(App\Repositories\Fare\Fare::class)->make([
            'id' => '1',
		'fare_id' => 'laravel',
		'price' => 'laravel',
		'currency_type' => 'laravel',
		'payment_method' => 'laravel',
		'transfers' => 'laravel',
		'transfer_duration' => 'laravel',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/fares');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/fares', $this->fare->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/fares', $this->fare->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/fares/1', $this->fareEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('fares', $this->fareEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/fares', $this->fare->toArray());
        $response = $this->call('DELETE', 'api/v1/fares/'.$this->fare->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'fare was deleted']);
    }

}
