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

		// 友链管理
		$api->get('links', 'LinkController@index')->name('links.index');
		$api->get('links/{id}', 'LinkController@show')->name('links.show');
		$api->post('links', 'LinkController@store')->name('links.store');
		$api->put('links/{id}', 'LinkController@update')->name('links.update');
		$api->delete('links/{id}', 'LinkController@destroy')->name('links.destroy');

		// 标签管理
		$api->get('tags', 'TagController@index')->name('tags.index');
		$api->get('tags/{id}', 'TagController@show')->name('tags.show');
		$api->post('tags', 'TagController@store')->name('tags.store');
		$api->put('tags/{id}', 'TagController@update')->name('tags.update');
		$api->delete('tags/{id}', 'TagController@destroy')->name('tags.destroy');

		// 分类管理
		$api->get('categories', 'CategoryController@index')->name('categories.index');
		$api->get('categories/{id}', 'CategoryController@show')->name('categories.show');
		$api->post('categories', 'CategoryController@store')->name('categories.store');
		$api->put('categories/{id}', 'CategoryController@update')->name('categories.update');
		$api->delete('categories/{id}', 'CategoryController@destroy')->name('tags.destroy');
	});

	$api->group(['namespace' => 'App\Api\Controllers'], function ($api) {

	});



});
