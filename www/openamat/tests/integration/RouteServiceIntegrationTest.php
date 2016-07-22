<?php

use App\Services\RouteService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteServiceIntegrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(RouteService::class);
        $this->originalArray = [
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

        ];
        $this->editedArray = [
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

        ];
        $this->searchTerm = '';
    }

    public function testAll()
    {
        $response = $this->service->all();
        $this->assertEquals(get_class($response), 'Illuminate\Database\Eloquent\Collection');
        $this->assertTrue(is_array($response->toArray()));
        $this->assertEquals(0, count($response->toArray()));
    }

    public function testPaginated()
    {
        $response = $this->service->paginated(25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testSearch()
    {
        $response = $this->service->search($this->searchTerm, 25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testCreate()
    {
        $response = $this->service->create($this->originalArray);
        $this->assertEquals(get_class($response), 'App\Repositories\Route\Route');
        $this->assertEquals(1, $response->id);
    }

    public function testFind()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->find($item->id);
        $this->assertEquals(1, $response->id);
    }

    public function testUpdate()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->update($item->id, $this->editedArray);

        $this->assertEquals(1, $response->id);
        $this->seeInDatabase('routes', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->destroy($item->id);
        $this->assertTrue($response);
    }

}

