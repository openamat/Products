<?php

namespace App\Repositories\Fare;

use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    public $table = "fares";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'fare_id',
		'price',
		'currency_type',
		'payment_method',
		'transfers',
		'transfer_duration',

    ];

    public static $rules = [
        // create rules
    ];

    // Fare 

}
