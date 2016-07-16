<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ServiceAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->service = factory(App\Repositories\Service\Service::class)->make([
            'id' => '1',
		'service_id' => 'laravel',
		'monday' => 'laravel',
		'tuesday' => 'laravel',
		'wednesday' => 'laravel',
		'thursday' => 'laravel',
		'friday' => 'laravel',
		'saturday' => 'laravel',
		'sunday' => 'laravel',
		'start_date' => '2016-07-16',
		'end_date' => '2016-07-16',

        ]);
        $this->serviceEdited = factory(App\Repositories\Service\Service::class)->make([
            'id' => '1',
		'service_id' => 'laravel',
		'monday' => 'laravel',
		'tuesday' => 'laravel',
		'wednesday' => 'laravel',
		'thursday' => 'laravel',
		'friday' => 'laravel',
		'saturday' => 'laravel',
		'sunday' => 'laravel',
		'start_date' => '2016-07-16',
		'end_date' => '2016-07-16',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/services');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/services', $this->service->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/services', $this->service->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/services/1', $this->serviceEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('services', $this->serviceEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/services', $this->service->toArray());
        $response = $this->call('DELETE', 'api/v1/services/'.$this->service->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'service was deleted']);
    }

}
