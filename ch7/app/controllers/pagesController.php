<?php

class pagesController extends BaseController {

	function register()
	{

	  if(Sentry::check()){
	  	return Redirect::to('myaccount');
	  }

	  return View::make("user.register")->with("title","The Foldagram - Register")
	  ->with("page_title","Register")->with('class','register');
	}

	function postRegister()
	{

   		$rules = array(
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        );

        $input = Input::all();
        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Redirect::to('register')->withInput()
									->withErrors($validation)
									->with('message', 'There were validation errors.');
        }

		try
		{


			    $user = Sentry::register(array(
					'email'    => Input::get('email'),
			        'password' => Input::get('password'),
					'first_name' => Input::get('first_name'),
					'last_name'  => Input::get('last_name'),
					'credit' => 0,
				), true);

		    if ($user)
		    {
		    	$subscribe = new Subscribe;
				$subscribe->email = Input::get('email');
				$subscribe->save();

		        return Redirect::to('login')->with('success','Hey! You have been registered successfully.');
		    }
		}
		catch (Sentry\SentryException $e)
		{
		    $errors = new Laravel\Messages();
            $errors->add('sentry', $e->getMessage());
            return Redirect::to('getregister')->withInput()->withErrors($errors); // catch errors such as user exists or bad fields
		}
	}

	public function getLogin()
	{
	  if(Sentry::check()){
	    return Redirect::to('myaccount');
	  }

	  return View::make("user.login")->with("title","The Foldagram - Login")
	  ->with("page_title","Login")->with('class','login');
	}

	public function Myaccount()
	{
	  if(!Sentry::check()){
	    return Redirect::to('login')->with("error", "Please login to access your account");
	  }

	  $user = Sentry::getUser();

	    $orders = DB::table('foldagram')
	    ->where('user_id','=',$user->id)->get();

		$pcredit = DB::table('usercreditorders')
	    ->where('user_id','=',$user->id)
	    ->orderBy('created_at','DESC')->get();

		return View::make("user.myaccount")->with("title","The Foldagram - My Account")
		->with("page_title","My Account")->with('class','myaccount')
		->with('user',$user)
		->with('orders',$orders)
		->with('pcredit',$pcredit);

	}


	function postLogin()
	{
	  $rules = array(
	      'email'  => 'required|email',
	      'password' => 'required',
	  );
	  $input = Input::get();
	  $validation = Validator::make($input, $rules);

	  if ($validation->fails())
	  {
	      return Redirect::to('login')->withInput()
									->withErrors($validation);
	  }

	  $credentials = array( 'email'=> Input::get('email'), 'password'=> Input::get('password') );

		if (Sentry::authenticate($credentials, false))
		{

		    return Redirect::to('myaccount');
		}
		else
		{
		    return Redirect::to('login')->with("error", "There is problem with login please try again");
		}

	}

	function changepassword()
	{
	  $rules = array(
	        'old_password' => 'required',
	        'password' => 'required|different:old_password|confirmed',
	        'password_confirmation' => 'required',
	    );



	    $input = Input::get();
	    $validation = Validator::make($input, $rules);



	    if ($validation->fails()) {
	        return Redirect::to('myaccount')->withInput()->withErrors($validation);
	    }

	  try
	  {
	      $user = Sentry::getUser();

		  if (! $user->checkPassword(Input::get('old_password'))){
		  	return Redirect::to('myaccount')->with('error', 'Your old password is not matching with your provided input.');
		  }


	      $user->password = Input::get('password');

	      if ($user->save())
	      {
	          return Redirect::to('myaccount')->with('success', 'Your password  has been updated successfully.');
	      }
	      else
	      {
	          return Redirect::to('myaccount')->with('error', 'Your password has been not update successfully.');
	      }

	  }
	  catch (Sentry\SentryException $e){
	  	$errors = new Laravel\Messages();
            $errors->add('sentry', $e->getMessage());
            return Redirect::to('myaccount')->withInput()->withErrors($errors);
	  }
	}

	function getCart(){

		$cart_contents = Cart::contents();

			return View::make('pages.cart')->with('cart_contents', $cart_contents)
		->with("page_title","Cart")->with("title","The Foldagram - Cart")->with('class','cart');
	}



	function postProfile(){





	  $rules = array(
	      'email' => 'required|email|unique:users,email,'.$user['id'],
	  );

	  $input = Input::get();
	  $validation = Validator::make($input, $rules);

	  if ($validation->fails()) {
	      return Redirect::to('myaccount')->withInput()->withErrors($validation);
	  }

	   $user_data = array(
	      'email'    => Input::get('email'),
	      'first_name' => Input::get('first_name'),
	      'last_name'  => Input::get('last_name'),
	   );

	  if ($user->update($user_data))
	  {
	      return Redirect::to('myaccount')->with('success', 'Your information has been updated successfully.');
	  }
	  else
	  {
	      return Redirect::to('myaccount')->with('error', 'Something went wrong!.');
	  }

	}

	function logout(){
		Sentry::logout();
		 return Redirect::to('/');
	}

	function checkout(){

   		$rules = array(
            'fullname' => 'required',
            'country' => 'required',
            'address_one' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'credit_owner' => 'required',
            'credit_number' => 'required',
            'code' => 'required'
        );

        $input = Input::all();
        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Redirect::to('/cart')->withInput()
									->withErrors($validation)
									->with('message', 'There were Input errors.');
        }

		if(Sentry::check()){
			$user = Sentry::getUser();
			$user_id = $user->id;
			$user_email = $user->email;
		}else{

		$password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );

		   $user = Sentry::createUser(array(
		        'email'     => $Input::get('email'),
		        'password'  => $password,
		        'activated' => true,
		    ));

		   $user_id = $user->id;
		   $user_email = $user->email;

		}

		  $order = new Order;
		  $cart_contents = Cart::contents();


		  foreach ( $cart_contents as $item) {
		       $order->qty = $item['qty'];
		       $order->price = $item['price'];
		  }

		  $order->foldaram_id =Input::get('foldagram_id');
		  $order->email = $user_email;
		  $order->fullname = Input::get('fullname');
		  $order->country = Input::get('country');
		  $order->address_one = Input::get('address_one');
		  $order->address_two = Input::get('address_two');
		  $order->city = Input::get('city');
		  $order->state = Input::get('state');
		  $order->zipcode = Input::get('zipcode');

		  $total_amount = Cart::total();

		  $order->save();

		  $amount = (float)$total_amount * 100;


		  $response = Stripe_Charge::create(
		    array(
		      "amount" =>$amount,
		      "currency" => "usd",
		      "card" => Input::get('stripeToken') ,
		      "description" => "Foldagram Payment"
		    )
		  );



		if($response->paid){

		    $order_data = Order::find($order->id);
		    $order_data->transection_id = $response->id;
		    $order_data->status = 1;

		    $order_data->save();

		    $foldagram_data = Foldagram::find(Input::get('foldagram_id'));
		    $foldagram_data->status = 2;
		    $foldagram_data->user_id = $user_id;
		    $foldagram_data->save();

		    Cart::destroy();

			return Redirect::to('myaccount')->with('success', 'Your order has been placed');

		  }


	}

	function get_purchase_credit()
	{

	  $credit = Credit::all();


	  return View::make("pages.purchase_credit")->with("title","The Foldagram - Purchase Credit")
	  ->with("page_title","Purchase Credit")->with('class','pcredit')
	  ->with('credit', $credit);

	}

	public function addtocredit()
	{

	  if(!Sentry::check()){
		  return Redirect::to('get_purchase_credit')->with('error', 'You need to be logged in for credit purchase');
	  }

	  $credit = Credit::where('rfrom','<=',intval(Input::get('qty')))
	          ->where('rto',">=",intval(Input::get('qty')))->orderBy('rfrom','DESC')->first();

	  $total_amount = $credit->price * Input::get('qty');

	  $amount = (float)$total_amount * 100;

	  $response = Stripe_Charge::create(array(
	        "amount" => $amount,
	        "currency" => "usd",
	        "card" => Input::get('stripeToken') , // obtained with Stripe.js
	        "description" => "Foldagram Payment")
	   );

	  if($response->paid){
	    $user = Sentry::getUser();
	    $order_data = new UserCreditOrders;
	    $order_data->transection_id = $response->id;
	    $order_data->status = 1;
        $order_data->user_id = $user->id;
        $order_data->qty = Input::get('qty');
        $order_data->price = $credit->price*Input::get('qty');
        $order_data->save();

        return Redirect::to('myaccount')->with('success', 'Your order of credits are successfull');
	  }
	}

	public function price($qty)
	{

		$credit = Credit::where('rfrom','<=',intval($qty))
					->where('rto',">=",intval($qty))->orderBy('rfrom','DESC')->first();

		if($credit){
			return $credit->price;
		}else {
			return 0;
		}
	}

}