<?php

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => 'api/v1', 'namespace' => 'Api'], function(){
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::get('refresh', 'AuthController@refresh');
        Route::group(['prefix' => 'user'], function() {
            Route::get('profile', 'UserController@getProfile');
            Route::post('profile', 'UserController@postProfile');
        });
    });
});

/*
|--------------------------------------------------------------------------
| Customer API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/customers', 'Api\CustomerController');
});

/*
|--------------------------------------------------------------------------
| Agency API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/agencies', 'Api\AgencyController');
});

/*
|--------------------------------------------------------------------------
| Route API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/routes', 'Api\RouteController');
});

/*
|--------------------------------------------------------------------------
| Shape API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/shapes', 'Api\ShapeController');
});

/*
|--------------------------------------------------------------------------
| Stop API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/stops', 'Api\StopController');
});

/*
|--------------------------------------------------------------------------
| Fare API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/fares', 'Api\FareController');
});

/*
|--------------------------------------------------------------------------
| Service API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/services', 'Api\ServiceController');
});

/*
|--------------------------------------------------------------------------
| FareRule API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/farerules', 'Api\FareRuleController');
});

/*
|--------------------------------------------------------------------------
| Trip API Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'jwt.auth'], function(){
    Route::resource('api/v1/trips', 'Api\TripController');
});


/*
|--------------------------------------------------------------------------
| Import Routes
|--------------------------------------------------------------------------
*/

Route::resource('api/v1/imports/basic', 'Api\ImportController');

