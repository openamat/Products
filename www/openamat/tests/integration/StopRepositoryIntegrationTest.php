<?php

use App\Repositories\Stop\StopRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StopRepositoryIntegrationTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->repo = $this->app->make(StopRepository::class);
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
        $response = $this->repo->all();
        $this->assertEquals(get_class($response), 'Illuminate\Database\Eloquent\Collection');
        $this->assertTrue(is_array($response->toArray()));
        $this->assertEquals(0, count($response->toArray()));
    }

    public function testPaginated()
    {
        $response = $this->repo->paginated(25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testSearch()
    {
        $response = $this->repo->search($this->searchTerm, 25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testCreate()
    {
        $response = $this->repo->create($this->originalArray);
        $this->assertEquals(get_class($response), 'App\Repositories\Stop\Stop');
        $this->assertEquals(1, $response->id);
    }

    public function testFind()
    {
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->find($item->id);
        $this->assertEquals(1, $response->id);
    }

    public function testUpdate()
    {
        // create the item
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->update($item->id, $this->editedArray);

        $this->assertEquals(1, $response->id);
        $this->seeInDatabase('stops', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->repo->create($this->originalArray);

        $response = $this->repo->destroy($item->id);
        $this->assertTrue($response);
    }

}

