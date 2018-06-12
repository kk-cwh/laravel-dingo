<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
// 后台登陆
	$api->post('auth/login', 'App\Api\Controllers\AuthController@login')->name('auth.login');

	$api->group(['namespace' => 'App\Api\Controllers','middleware'=>'auth:api'], function ($api) {
		$api->get('auth/me', 'AuthController@me')->name('auth.me');
		$api->delete('auth/logout', 'AuthController@logout')->name('auth.logout');
		$api->patch('auth/refresh', 'AuthController@refresh')->name('auth.refresh');

		// 用户管理
		$api->get('users', 'UserController@index')->name('users.index');
		$api->get('users/{id}', 'UserController@show')->name('users.show');
		$api->post('users', 'UserController@store')->name('users.store');
		$api->put('users/{id}', 'UserController@update')->name('users.update');
		$api->delete('users/{id}', 'UserController@destroy')->name('users.destroy');
	});

	$api->group(['namespace' => 'App\Api\Controllers'], function ($api) {

	});



});
