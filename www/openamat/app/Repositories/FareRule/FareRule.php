<?php

namespace App\Repositories\FareRule;

use Illuminate\Database\Eloquent\Model;

class FareRule extends Model
{
    public $table = "farerules";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'fare_id',
		'route_id',
		'origin_id',
		'destination_id',
		'contains_id',

    ];

    public static $rules = [
        // create rules
    ];

    // FareRule 

}
