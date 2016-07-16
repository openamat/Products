<?php

namespace App\Repositories\Agency;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    public $table = "agencies";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'agency_id',
		'agency_name',
		'agency_url',
		'agency_timezone',
		'agency_lang',
		'agency_phone',
		'agency_fare_url',

    ];

    public static $rules = [
        // create rules
    ];

    // Agency 

}
