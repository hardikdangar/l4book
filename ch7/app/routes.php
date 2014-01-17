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

Route::get('contact', array('as' => 'contact', 'uses' => 'pages@contact'));
Route::post('create', array('as' => 'create','uses'=>'FoldagramController@create'));
Route::post('edit', array('as' => 'edit','uses'=>'FoldagramController@edit'));
Route::get('/remove/{id}/{rowid}', array('as' => 'remove', 'uses' => 'FoldagramController@removeddress'));
Route::post('updateraddress', array('as' => 'updateraddress', 'uses' => 'FoldagramController@updateraddress'));

Route::get('register', array('as' => 'getregister', 'uses' => 'pagesController@register'));
Route::post('register', array('as' => 'postregister', 'uses' => 'pagesController@postRegister'));

Route::get('myaccount', array('as' => 'myaccount', 'uses' => 'pagesController@myaccount'));
Route::post('myaccount/profile', array('before'=>'csrf','', 'uses' => 'pagesController@postProfile'));

Route::post('myaccount/changepassword', array('before'=>'csrf','as' => 'changepassword', 'uses' => 'pagesController@changepassword'));

Route::get('logout', array('as' => 'frontlogout', 'uses' => 'pagesController@logout'));

Route::get('cart', array('as' => 'cart', 'uses' => 'pagesController@getCart'));

Route::get('price/{value}','pagesController@price');

Route::post('checkout', array('before'=>'csrf','as' => 'checkout', 'uses' => 'pagesController@checkout'));
Route::get('purchasecredit', array('as' => 'pcredit', 'uses' => 'pagesController@get_purchase_credit'));
Route::post('addtocredit', array("as"=>'addtocredit', 'uses'=> 'pagesController@addtocredit'));




Route::get('login', array('https' => false,'as' => 'userlogin', 'uses' => 'pagesController@getlogin'));
Route::post('login', array('https' => false,'before'=>'csrf','as' => 'postuserlogin', 'uses' => 'pagesController@postlogin'));




//------------------- Admin User --------//


Route::get('/creategroup', function()
{
	try
	{
	    // Create the group
	    $group = Sentry::createGroup(array(
	        'name'        => 'Administration',
	        'permissions' => array(
	            'read' => 1,
	            'write' => 1,
	        ),
	    ));

	    echo "Administration Group is created";
	}
	catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
	{
	    echo 'Name field is required';
	}
	catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
	{
	    echo 'Group already exists';
	}

});


Route::get('/checkgroup', function()
{

	try
	{
	    $group = Sentry::findGroupByName('administration');
	    echo "Administration Group Exists";
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}

});

Route::get('/createadminuser', function()
{

	try
	{

	    // Find the group using the group name
	    $adminGroup = Sentry::findGroupByName("administration");

	    // Create the user
	    $user = Sentry::createUser(array(
	        'email'    => 'hardik@sphererays.net',
	        'password' => '123456',
			'activated'   => true,
	    ));

	    echo "Admin user is created<br>";


	    // Assign the group to the user
	    $user->addGroup($adminGroup);

	    echo "Admin user assigned to administration group";
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
	    echo 'Password field is required.';
	}
	catch (Cartalyst\Sentry\Users\UserExistsException $e)
	{
	    echo 'User with this login already exists.';
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}

});


Route::get('admin', array('as' => 'admin', 'uses' => 'AdminController@dashboard'));
Route::get('admin/login', array('as' => 'adminlogin', 'uses' => 'AdminController@getLogin'));
Route::post('admin/login', array('as' => 'adminlogin', 'uses' => 'AdminController@postLogin'));
//Route::get('admin/logout', array('as' => 'adminlogout', 'uses' => 'AdminController@logout'));

Route::group(array('before' => 'administrationauth'), function()
{
	Route::controller('admin','AdminController');
	Route::controller('users', 'UserController');
});





//------------------- End Admin User --------//








