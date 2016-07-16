<?php

namespace App\Repositories\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table = "services";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'service_id',
		'monday',
		'tuesday',
		'wednesday',
		'thursday',
		'friday',
		'saturday',
		'sunday',
		'start_date',
		'end_date',

    ];

    public static $rules = [
        // create rules
    ];

    // Service 

}
