<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
*/

//Route::get('/', 'PagesController@home');
Route::get('/', 'Auth\AuthController@getLogin');

/*
|--------------------------------------------------------------------------
| Login/ Logout/ Password
|--------------------------------------------------------------------------
*/
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*
|--------------------------------------------------------------------------
| Registration
|--------------------------------------------------------------------------
*/
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function(){

    Route::get('/users/switch-back', 'Admin\UserController@switchUserBack');

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'user', 'namespace' => 'User'], function(){
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@update');
        Route::get('password', 'PasswordController@password');
        Route::post('password', 'PasswordController@update');
    });

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', 'PagesController@dashboard');

    /*
    |--------------------------------------------------------------------------
    | Team Routes
    |--------------------------------------------------------------------------
    */

    Route::get('team/{name}', 'TeamController@showByName');
    Route::resource('teams', 'TeamController', ['except' => ['show']]);
    Route::post('teams/search', 'TeamController@search');
    Route::post('teams/{id}/invite', 'TeamController@inviteMember');
    Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function(){

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */
        Route::resource('users', 'UserController', ['except' => ['create', 'show']]);
        Route::post('users/search', 'UserController@search');
        Route::get('users/search', 'UserController@index');
        Route::get('users/invite', 'UserController@getInvite');
        Route::get('users/switch/{id}', 'UserController@switchToUser');
        Route::post('users/invite', 'UserController@postInvite');

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */
        Route::resource('roles', 'RoleController', ['except' => ['show']]);
        Route::post('roles/search', 'RoleController@search');
        Route::get('roles/search', 'RoleController@index');

        /*
        |--------------------------------------------------------------------------
        | Agency Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('agencies', 'AgencyController', ['except' => ['show']]);
        Route::post('agencies/search', [
            'as' => 'agencies.search',
            'uses' => 'AgencyController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Route Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('routes', 'RouteController', ['except' => ['show']]);
        Route::post('routes/search', [
            'as' => 'routes.search',
            'uses' => 'RouteController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Shape Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('shapes', 'ShapeController', ['except' => ['show']]);
        Route::post('shapes/search', [
            'as' => 'shapes.search',
            'uses' => 'ShapeController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Stop Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('stops', 'StopController', ['except' => ['show']]);
        Route::post('stops/search', [
            'as' => 'stops.search',
            'uses' => 'StopController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Fare Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('fares', 'FareController', ['except' => ['show']]);
        Route::post('fares/search', [
            'as' => 'fares.search',
            'uses' => 'FareController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Service Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('services', 'ServiceController', ['except' => ['show']]);
        Route::post('services/search', [
            'as' => 'services.search',
            'uses' => 'ServiceController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | FareRule Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('farerules', 'FareRuleController', ['except' => ['show']]);
        Route::post('farerules/search', [
            'as' => 'farerules.search',
            'uses' => 'FareRuleController@search'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Trip Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('trips', 'TripController', ['except' => ['show']]);
        Route::post('trips/search', [
            'as' => 'trips.search',
            'uses' => 'TripController@search'
        ]);


    });
});
