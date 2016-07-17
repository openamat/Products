<?php

namespace App\Repositories\Trip;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    public $table = "trips";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
		'id',
		'route_id',
		'service_id',
		'trip_id',
		'trip_headsign',
		'direction_id',
		'block_id',
		'shape_id'
	];

    public static $rules = [
        // create rules
    ];

    // Trip 

}
