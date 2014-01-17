<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

//for authentication

// Route::group(array('prefix' => 'locator/api/service/v1', 'before' => 'Apiauth'), function()
// {
//     Route::resource('store', 'StoreController');
// });


//without authentication for testing...

Route::group(array('prefix' => 'locator/api/service/v1'), function()
{
    Route::resource('store', 'StoreController');
});