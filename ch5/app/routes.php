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


Route::get('/cartmessage', function()
{
  	// $cart = new Acme\Cart\Cart;
  	// echo $cart->message();

	return Cart::message();
});

Route::get('/cartcheck',function(){

  // $item = array(
  //   'id'      => 1,
  //   'qty'     => '3',
  //   'price'   => '100',
  //   'name'    => 'Foldagram'
  // );

  // // Add the item to the shopping cart.
  // Cart::insert($item);

  $items = Cart::contents();

  var_dump($items);

});

Route::get('/', function()
{
	return View::make('home')->with('title','The Foldagram')
							 ->with('class','home');
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

Route::post('create', array('as' => 'create','uses'=>'FoldagramController@create'));
Route::post('edit', array('as' => 'edit','uses'=>'FoldagramController@edit'));
Route::get('/remove/{id}/{rowid}', array('as' => 'remove', 'uses' => 'FoldagramController@removeddress'));
Route::post('updateraddress', array('as' => 'updateraddress', 'uses' => 'FoldagramController@updateraddress'));





//-------------------



Route::get('purchasecredit', array('as' => 'pcredit', 'uses' => 'pages@purchasecredit'));
Route::get('contact', array('as' => 'contact', 'uses' => 'pages@contact'));
Route::get('login', array('https' => false,'as' => 'userlogin', 'uses' => 'pages@login'));
Route::get('register', array('as' => 'register', 'uses' => 'pages@register'));
Route::post('register', array('before'=>'csrf','as' => 'postregister', 'uses' => 'pages@register'));
Route::post('login', array('https' => false,'before'=>'csrf','as' => 'postuserlogin', 'uses' => 'pages@login'));
Route::post('admin/login', array('as' => 'login', 'uses' => 'admin@login'));
Route::get('cart', array('as' => 'cart', 'uses' => 'foldagram@cart'));