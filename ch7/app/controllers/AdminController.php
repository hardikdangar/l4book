<?php

class AdminController extends BaseController {


	public function getLogin()
	{
		return View::make('layouts.login')->with('title','Foldagram - Admin');
	}

	public function getLogout(){

	}

	public function getUpdate($id)
	{
		if(!empty($id))
		{
		    $foldagram = Foldagram::find($id);

		  	return View::make('admin.update_status')->with('title','Foldagram - Admin')
			->with("page_title","Foldagram Update Status")
			->with('foldagram', $foldagram);

		}else{
			return Redirect::to('admin/index');
		}
	}

	public function postUpdate()
	{
		$foldagram = Foldagram::find(Input::get('id'));
		$foldagram->status=Input::get('status');

		if($foldagram->save()){
			return Redirect::to('admin/index')->with('success', 'Foldagram order has been status updated successfully.');
		}
	}

	public function getDelete($id="")
	{

		if(!empty($id)){

			$foldagram = Foldagram::find($id)->delete();
			$raddress = Recipients::where('foldaram_id','=',$id)->delete();
			$order_detail = Order::where('foldaram_id','=',$id)->delete();

			if($foldagram){
				return Redirect::to_route('orders')->with('success', 'Foldagram order has been deleted successfully.');
			}else {
				return Redirect::to_route('orders')->with('error',"order not deleted, please try again");
			}

		}else {
			return Redirect::to_route('orders')->with('error',"order not deleted, please try again");

		}

	}

	public function getCsvexport()
	{

		$output = Foldagram::join('orders', 'foldagram.id', '=', 'orders.foldaram_id')
					->where('orders.status','=',1)
					->where('foldagram.status','=',2)
					->where('foldagram.exported','=',0)->get();

		$output = $output->toArray();

		$file = fopen('uploads/file.csv', 'w');

	    foreach ($output as $row) {
	        fputcsv($file, $row);
	    }

		fclose($file);

	    $headers = array(
	        'Content-Type' => 'text/csv',
	        'Content-Disposition' => 'attachment; filename="$file"',
	     );

	    return Response::download("uploads/file.csv", "orders.csv", $headers);
	}

	public function getAddcredit()
	{

		return View::make('admin.add_credit')->with('title','Foldagram - Admin')
		->with("page_title","Add Price");
	}

	public function postAddcredit()
	{
		$credit = new Credit();

		$credit->rfrom = Input::get('rfrom');
		$credit->rto = Input::get('rto');
		$credit->price = Input::get('price');

		if($credit->save()){
			return Redirect::to('admin/managecredit')->with('success', 'Price has been added successfully.');
		}else {
			return Redirect::to('admin/managecredit')->with_errors($credit->errors)->with_input()->with("title","The Foldagram - Admin");
		}
	}

	public function getManagecredit()
	{

		$credit = Credit::all();

		return View::make('admin.manage_credit')->with('title','Foldagram - Admin')
		->with("page_title","Manage Price")
		->with('credit',$credit);

	}

	public function getEditcredit($id){
		if(!empty($id)){
			$credit = Credit::find($id);

		return View::make('admin.edit_credit')->with('title','Foldagram - Admin')
		->with("page_title","Edit Price")
		->with('credit',$credit);
		}else {
			return Redirect::to('admin/managecredit')->with('error',"Price id not found")->with("title","The Foldagram - Admin");
		}
	}

	public function postEditcredit(){
		$credit = Credit::find(Input::get("id"));

		$credit->rfrom = Input::get('rfrom');
		$credit->rto = Input::get('rto');
		$credit->price = Input::get('price');

		if($credit->save()){
			return Redirect::to('admin/managecredit')->with('success', 'Price has been updated successfully.');
		}else {
			return Redirect::to('admin/managecredit')->withErrors($credit->errors)->withInput()->with("title","The Foldagram - Admin");
		}

	}

	public function getDeletecredit($id){
		$credit = Credit::where('id','=', $id)->delete();

		if($credit){
			return Redirect::to('admin/managecredit')->with('success', 'Price has been deleted successfully.');
		}else {
			return Redirect::to('admin/managecredit')->with('error',"Price not deleted, please try again")->with("title","The Foldagram - Admin");
		}
	}


	public function getUsercredit()
	{
		$users = User::all();

		$userarray = array();

		foreach($users as $value){
			$userarray[$value['id']] = $value['email'];
		}

		return View::make('admin.user_credit')->with('title','Foldagram - Admin')
		->with("page_title","Give User Credit")
		->with('users',$userarray);
	}

	public function postUsercredit()
	{

		$user = Sentry::findUserById(Input::get('user_email'));

		$credit = $user->credit + Input::get('credit');

		$user->credit = $credit;

		if ($user->update())
		{
		    return Redirect::to('admin/usercredit')->with('success','Hey! User credit has been updated successfully');
		}
		else
		{
		    return Redirect::to('admin/usercredit')->with('error','Hey! User credit has been not updated successfully');
		}

	}



	public function getIndex()
	{
		$orders = DB::table('foldagram')
		->leftJoin('users', 'foldagram.user_id', '=', 'users.id')
		->leftJoin('orders', 'foldagram.id', '=', 'orders.foldaram_id')
		->orderBy('foldagram.created_at','DESC')
		->groupBy("foldagram.id")
		->get();

		return View::make('admin.manage_orders')->with('title','Foldagram - Admin')
		->with("page_title","Manage Order")
		->with('orders',$orders);

	}

	public function getRecipient($id="")
	{

		$reff = DB::table('foldagram_reff_address')->where('foldaram_id','=',$id)->get();

		return View::make('admin.view_recipeint')->with('title','Foldagram - Admin')
		->with("page_title","List of Recipient's")
		->with('reff',$reff);

	}

	public function getOrderdetail($id)
	{

		$order_detail = Order::where('foldaram_id','=',$id)->first();

		return View::make('admin.view_order_details')->with('title','Foldagram - Admin')
		->with("page_title","Order Details")
		->with('order_detail', $order_detail);
	}


	public function postLogin()
	{

		$rules = array(
		    'username'  => 'required|max:50',
		    'password' => 'required',
		);

	    $credentials = array(
	        'username'    => Input::get('username'),
	        'password' => Input::get('password'),
	    );


		$validation = Validator::make($credentials, $rules);



		if ($validation->fails())
		{
		    return Redirect::to('admin/login')->withErrors($validation)->withInput()->with("title","The Foldagram - Admin ");
		}

		try
		{

	 		$credentials = array(
		        'email'    => Input::get('username'),
		        'password' => Input::get('password'),
		    );

			$user = Sentry::authenticate($credentials, false);

			if (Sentry::check())
			{
				$admin = Sentry::findGroupByName('Administration');

				if ($user->inGroup($admin))
			    {
			    	return Redirect::to('admin/index');
			    }
			}
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Login field is required.'));
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Password field is required.'));
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'Wrong password, try again.'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User was not found.'));
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is not activated.'));
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is suspended.'));
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			return Redirect::to('admin/login')->withErrors(array('message' => 'User is banned.'));
		}

	}


}