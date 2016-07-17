<?php

use App\Services\TripService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TripServiceIntegrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(TripService::class);
        $this->originalArray = [
            'id' => '1',
		'route_id' => 'laravel',
		'service_id' => 'laravel',
		'trip_id' => 'laravel',
		'trip_headsign' => 'laravel',
		'direction_id' => 'laravel',
		'block_id' => 'laravel',
		'shape_id' => 'laravel',

        ];
        $this->editedArray = [
            'id' => '1',
		'route_id' => 'laravel',
		'service_id' => 'laravel',
		'trip_id' => 'laravel',
		'trip_headsign' => 'laravel',
		'direction_id' => 'laravel',
		'block_id' => 'laravel',
		'shape_id' => 'laravel',

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
        $this->assertEquals(get_class($response), 'App\Repositories\Trip\Trip');
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
        $this->seeInDatabase('trips', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->destroy($item->id);
        $this->assertTrue($response);
    }

}

