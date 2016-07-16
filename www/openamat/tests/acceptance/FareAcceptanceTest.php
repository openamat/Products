<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FareAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'fares');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('fares');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'fares/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'fares', $this->fare->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('fares/'.$this->fare->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'fares', $this->fare->toArray());

        $response = $this->actor->call('GET', '/fares/'.$this->fare->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('fare');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'fares', $this->fare->toArray());
        $response = $this->actor->call('PATCH', 'fares/1', $this->fareEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('fares', $this->fareEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'fares', $this->fare->toArray());

        $response = $this->call('DELETE', 'fares/'.$this->fare->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('fares');
    }

}
