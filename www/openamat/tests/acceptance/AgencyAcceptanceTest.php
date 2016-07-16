<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AgencyAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'agencies');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('agencies');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'agencies/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'agencies', $this->agency->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('agencies/'.$this->agency->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'agencies', $this->agency->toArray());

        $response = $this->actor->call('GET', '/agencies/'.$this->agency->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('agency');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'agencies', $this->agency->toArray());
        $response = $this->actor->call('PATCH', 'agencies/1', $this->agencyEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('agencies', $this->agencyEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'agencies', $this->agency->toArray());

        $response = $this->call('DELETE', 'agencies/'.$this->agency->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('agencies');
    }

}
