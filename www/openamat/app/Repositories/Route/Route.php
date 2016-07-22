<?php

namespace App\Repositories\Route;

use App\Repositories\Agency\Agency;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $table = "routes";

    public $primaryKey = "id";

    public $timestamps = true;

	public $fillable = [
		'id',
		'route_id',
		'agency_id',
		'route_short_name',
		'route_long_name',
		'route_desc',
		'route_type',
		'route_url',
		'route_color',
		'route_text_color'
    ];

    public static $rules = [
        // create rules
    ];

    
	public function agency_id() {
		return $this->hasOne(Agency::class);
	}

}
