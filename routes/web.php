<?php

use Illuminate\Http\Request;
//use App\Master_model;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::get('cache_clear', function () {
	\Artisan::call('cache:clear');
	\Artisan::call('config:cache');
		//  Clears route cache
	\Artisan::call('route:clear');
	\Cache::flush();
//	\Artisan::call('optimize');
	exec('composer dump-autoload');
	Cache::flush();
	dd("Cache cleared!");
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Route::middleware(['ApiDataLogger1'])->group(function () {
//dd('12');
$router->get('web/get_users', ['uses' => 'ExampleController@index']);

$router->post('web/login', ['uses' => 'Api\AuthController@login']);

$router->get('web/get_profile', ['uses' => 'Api\ProfileController@get_profile']);
$router->post('web/update_profile', ['uses' => 'Api\ProfileController@update_profile']);


$router->group(['prefix' => 'web/projects'], function () use ($router)
{
	$router->get('list', ['uses' => 'Api\ProjectController@index']);
	$router->post('store', ['uses' => 'Api\ProjectController@store']);   
	$router->get('edit', ['uses' => 'Api\ProjectController@edit']);   
	$router->post('update', ['uses' => 'Api\ProjectController@update']);   
	$router->get('change_status', ['uses' => 'Api\ProjectController@change_status']);   
	$router->get('delete', ['uses' => 'Api\ProjectController@delete']);   

	$router->get('get_active_list', ['uses' => 'Api\ProjectController@get_active_list']);   
	$router->post('get_pr_dr_location', ['uses' => 'Api\ProjectController@get_pr_dr_location']);   
	
});

$router->group(['prefix' => 'web/contacts'], function () use ($router)
{
	$router->get('list', ['uses' => 'Api\ContactController@index']);
	$router->post('store', ['uses' => 'Api\ContactController@store']);   
	$router->get('edit', ['uses' => 'Api\ContactController@edit']);   
	$router->post('update', ['uses' => 'Api\ContactController@update']);  
	$router->get('delete', ['uses' => 'Api\ContactController@delete']);   
});

$router->group(['prefix' => 'web/business_applications'], function () use ($router)
{
	$router->get('list', ['uses' => 'Api\BusinessApplicationController@index']);
	$router->post('store', ['uses' => 'Api\BusinessApplicationController@store']);   
	$router->get('edit', ['uses' => 'Api\BusinessApplicationController@edit']);   
	$router->post('update', ['uses' => 'Api\BusinessApplicationController@update']);  
	$router->get('delete', ['uses' => 'Api\BusinessApplicationController@delete']);   
});

$router->group(['prefix' => 'web/servers'], function () use ($router)
{
	$router->get('list', ['uses' => 'Api\ServerController@index']);
	$router->post('store', ['uses' => 'Api\ServerController@store']);   
	$router->get('edit', ['uses' => 'Api\ServerController@edit']);   
	$router->post('update', ['uses' => 'Api\ServerController@update']);  
	$router->get('change_status', ['uses' => 'Api\ServerController@change_status']);   
	$router->get('delete', ['uses' => 'Api\ServerController@delete']);   
	$router->get('check_status', ['uses' => 'Api\ServerController@check_status']);   

	$router->get('get_os', ['uses' => 'Api\ServerController@get_os']);   
	$router->get('get_os_arch', ['uses' => 'Api\ServerController@get_os_arch']);   
	
	$router->post('get_os_family', ['uses' => 'Api\ServerController@get_os_family']);

});


//});


