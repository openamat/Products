<?php

namespace App\Repositories\Stop;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    public $table = "stops";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'stop_id',
		'stop_code',
		'stop_name',
		'stop_desc',
		'stop_lat',
		'stop_lon',
		'zone_id',
		'stop_url',
		'location_type',
		'parent_station',
		'stop_timezone',
		'wheelchair_boarding',

    ];

    public static $rules = [
        // create rules
    ];

    // Stop 

}
