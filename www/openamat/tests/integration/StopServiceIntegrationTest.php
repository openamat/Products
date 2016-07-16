<?php

use App\Services\StopService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StopServiceIntegrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(StopService::class);
        $this->originalArray = [
            'id' => '1',
		'stop_id' => 'laravel',
		'stop_code' => 'laravel',
		'stop_name' => 'laravel',
		'stop_desc' => 'laravel',
		'stop_lat' => '1',
		'stop_lon' => '1',
		'zone_id' => '1',
		'stop_url' => 'laravel',
		'location_type' => 'laravel',
		'parent_station' => 'laravel',
		'stop_timezone' => 'laravel',
		'wheelchair_boarding' => 'laravel',

        ];
        $this->editedArray = [
            'id' => '1',
		'stop_id' => 'laravel',
		'stop_code' => 'laravel',
		'stop_name' => 'laravel',
		'stop_desc' => 'laravel',
		'stop_lat' => '1',
		'stop_lon' => '1',
		'zone_id' => '1',
		'stop_url' => 'laravel',
		'location_type' => 'laravel',
		'parent_station' => 'laravel',
		'stop_timezone' => 'laravel',
		'wheelchair_boarding' => 'laravel',

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
        $this->assertEquals(get_class($response), 'App\Repositories\Stop\Stop');
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
        $this->seeInDatabase('stops', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->destroy($item->id);
        $this->assertTrue($response);
    }

}

