<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Repositories\User\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/*
|--------------------------------------------------------------------------
| UserMeta Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\UserMeta\UserMeta::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'phone' => $faker->phoneNumber,
        'marketing' => 1,
        'terms_and_cond' => 1,
    ];
});

$factory->define(App\Repositories\Role\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => 'member',
        'label' => 'Member',
    ];
});

/*
|--------------------------------------------------------------------------
| Team Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Team\Team::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name
    ];
});

/*
|--------------------------------------------------------------------------
| Agency Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Agency\Agency::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'agency_id' => 'laravel',
		'agency_name' => 'laravel',
		'agency_url' => 'laravel',
		'agency_timezone' => 'laravel',
		'agency_lang' => 'laravel',
		'agency_phone' => 'laravel',
		'agency_fare_url' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Route Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Route\Route::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'route_id' => 'laravel',
		'agency_id' => '1',
		'route_short_name' => 'laravel',
		'route_long_name' => 'laravel',
		'route_desc' => 'laravel',
		'route_type' => 'laravel',
		'route_url' => 'laravel',
		'route_color' => 'laravel',
		'route_text_color' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Route Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Route\Route::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'route_id' => 'laravel',
		'agency_id' => '1',
		'route_short_name' => 'laravel',
		'route_long_name' => 'laravel',
		'route_desc' => 'laravel',
		'route_type' => 'laravel',
		'route_url' => 'laravel',
		'route_color' => 'laravel',
		'route_text_color' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Route Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Route\Route::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'route_id' => 'laravel',
		'agency_id' => '1',
		'route_short_name' => 'laravel',
		'route_long_name' => 'laravel',
		'route_desc' => 'laravel',
		'route_type' => 'laravel',
		'route_url' => 'laravel',
		'route_color' => 'laravel',
		'route_text_color' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Shape Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Shape\Shape::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'shape_id' => 'laravel',
		'shape_pt_lat' => '1',
		'shape_pt_lon' => '1',
		'shape_pt_sequence' => '1',
		'shape_dist_traveled' => '1',


    ];
});

/*
|--------------------------------------------------------------------------
| Stop Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Stop\Stop::class, function (Faker\Generator $faker) {
    return [

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
});

/*
|--------------------------------------------------------------------------
| Fare Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Fare\Fare::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'fare_id' => 'laravel',
		'price' => 'laravel',
		'currency_type' => 'laravel',
		'payment_method' => 'laravel',
		'transfers' => 'laravel',
		'transfer_duration' => 'laravel',


    ];
});

/*
|--------------------------------------------------------------------------
| Service Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\Service\Service::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'service_id' => 'laravel',
		'monday' => 'laravel',
		'tuesday' => 'laravel',
		'wednesday' => 'laravel',
		'thursday' => 'laravel',
		'friday' => 'laravel',
		'saturday' => 'laravel',
		'sunday' => 'laravel',
		'start_date' => '2016-07-16',
		'end_date' => '2016-07-16',


    ];
});

/*
|--------------------------------------------------------------------------
| FareRule Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\FareRule\FareRule::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'fare_id' => '1',
		'route_id' => '1',
		'origin_id' => '1',
		'destination_id' => '1',
		'contains_id' => '1',


    ];
});

/*
|--------------------------------------------------------------------------
| FareRule Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Repositories\FareRule\FareRule::class, function (Faker\Generator $faker) {
    return [

        'id' => '1',
		'fare_id' => '1',
		'route_id' => '1',
		'origin_id' => '1',
		'destination_id' => '1',
		'contains_id' => '1',


    ];
});
