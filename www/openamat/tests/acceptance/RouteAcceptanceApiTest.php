<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->route = factory(App\Repositories\Route\Route::class)->make([
            'id' => '1',
		'route_id' => 'laravel',
		'agency_id' => '1',
		'route_short_name' => 'laravel',
		'route_long_name' => 'laravel',
		'route_desc' => 'laravel',
		'route_type' => 'laravel',
		'route_url' => 'laravel',
		'route_color' => 'laravel',
		'route_text_color' => 'laravel',

        ]);
        $this->routeEdited = factory(App\Repositories\Route\Route::class)->make([
            'id' => '1',
		'route_id' => 'laravel',
		'agency_id' => '1',
		'route_short_name' => 'laravel',
		'route_long_name' => 'laravel',
		'route_desc' => 'laravel',
		'route_type' => 'laravel',
		'route_url' => 'laravel',
		'route_color' => 'laravel',
		'route_text_color' => 'laravel',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/routes');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/routes', $this->route->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/routes', $this->route->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/routes/1', $this->routeEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('routes', $this->routeEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/routes', $this->route->toArray());
        $response = $this->call('DELETE', 'api/v1/routes/'.$this->route->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'route was deleted']);
    }

}
