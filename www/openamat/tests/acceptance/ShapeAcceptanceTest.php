<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShapeAcceptanceTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->shape = factory(App\Repositories\Shape\Shape::class)->make([
            'id' => '1',
		'shape_id' => 'laravel',
		'shape_pt_lat' => '1',
		'shape_pt_lon' => '1',
		'shape_pt_sequence' => '1',
		'shape_dist_traveled' => '1',

        ]);
        $this->shapeEdited = factory(App\Repositories\Shape\Shape::class)->make([
            'id' => '1',
		'shape_id' => 'laravel',
		'shape_pt_lat' => '1',
		'shape_pt_lon' => '1',
		'shape_pt_sequence' => '1',
		'shape_dist_traveled' => '1',

        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'shapes');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('shapes');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'shapes/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'shapes', $this->shape->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('shapes/'.$this->shape->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'shapes', $this->shape->toArray());

        $response = $this->actor->call('GET', '/shapes/'.$this->shape->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('shape');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'shapes', $this->shape->toArray());
        $response = $this->actor->call('PATCH', 'shapes/1', $this->shapeEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('shapes', $this->shapeEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'shapes', $this->shape->toArray());

        $response = $this->call('DELETE', 'shapes/'.$this->shape->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('shapes');
    }

}
