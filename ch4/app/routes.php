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

Route::get('/', function()
{
	return View::make('home')->with('title','The Foldagram')->with('class','home');
});

Route::get('/about', array('as' => 'about', function()
{
	return View::make('about')->with('title','About Foldagram')->with('class','about');
}));

Route::post('/subscribe', function()
{
	$input = Input::all();
	$rules = array("email"=>"required|email");

	$validation = Validator::make($input, $rules);
	if ($validation->passes())
	{
		Subscribe::create($input);
		return Redirect::to('home')->with('success', 'Thanks for signing Up Foldagram.');
	}

	return Redirect::to('/')
		->withInput()
		->withErrors($validation)
		->with('message', 'There were validation errors.');

});



















Route::get('purchagecredit', array('as' => 'pcredit', 'uses' => 'pages@purchage_credit'));
Route::get('cart', array('as' => 'cart', 'uses' => 'foldagram@cart'));
Route::get('cart/remove/(:any)/(:any)', array('as' => 'cart', 'uses' => 'foldagram@remove'));
Route::get('contact', array('as' => 'contact', 'uses' => 'pages@contact'));
Route::get('login', array('https' => false,'as' => 'userlogin', 'uses' => 'pages@login'));
Route::get('register', array('as' => 'register', 'uses' => 'pages@register'));

Route::post('register', array('before'=>'csrf','as' => 'postregister', 'uses' => 'pages@register'));

Route::post('login', array('https' => false,'before'=>'csrf','as' => 'postuserlogin', 'uses' => 'pages@login'));


Route::post('admin/login', array('as' => 'login', 'uses' => 'admin@login'));
Route::post('create', array('before'=>'csrf','as' => 'create', 'uses' => 'foldagram@create'));