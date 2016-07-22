<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AgencyAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->agency = factory(App\Repositories\Agency\Agency::class)->make([
            'id' => '1',
		'agency_id' => 'laravel',
		'agency_name' => 'laravel',
		'agency_url' => 'laravel',
		'agency_timezone' => 'laravel',
		'agency_lang' => 'laravel',
		'agency_phone' => 'laravel',
		'agency_fare_url' => 'laravel',

        ]);
        $this->agencyEdited = factory(App\Repositories\Agency\Agency::class)->make([
            'id' => '1',
		'agency_id' => 'laravel',
		'agency_name' => 'laravel',
		'agency_url' => 'laravel',
		'agency_timezone' => 'laravel',
		'agency_lang' => 'laravel',
		'agency_phone' => 'laravel',
		'agency_fare_url' => 'laravel',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/agencies');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/agencies', $this->agency->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/agencies', $this->agency->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/agencies/1', $this->agencyEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('agencies', $this->agencyEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/agencies', $this->agency->toArray());
        $response = $this->call('DELETE', 'api/v1/agencies/'.$this->agency->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'agency was deleted']);
    }

}
