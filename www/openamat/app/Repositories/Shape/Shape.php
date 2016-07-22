<?php

namespace App\Repositories\Shape;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{
    public $table = "shapes";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        		'id',
		'shape_id',
		'shape_pt_lat',
		'shape_pt_lon',
		'shape_pt_sequence',
		'shape_dist_traveled',

    ];

    public static $rules = [
        // create rules
    ];

    // Shape 

}
