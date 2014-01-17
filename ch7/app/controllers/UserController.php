<?php

class UserController extends BaseController {

	public function getIndex()
	{
		$users = User::all();

		return View::make('admin.manage_user')->with('title','Foldagram - Admin')
		->with("page_title","Manage User")
		->with('users',$users);
	}

	public function getAdduser()
	{
		return View::make('admin.add_user')->with('title','Foldagram - Admin')->with("page_title","Add User");
	}

	public function postAdduser()
	{
	    $rules = array(
	        'email' => 'required|email|unique:users',
	        'password' => 'required|confirmed',
	        'password_confirmation' => 'required'
	    );

	    $input = Input::get();
	    $validation = Validator::make($input, $rules);

	    if ($validation->fails()) {
	        return Redirect::to('users/adduser')->withInput()->withErrors($validation);
	    }

	    $user = Sentry::createUser(array(
	        'email'     => Input::get('email'),
	        'password'  => Input::get('password'),
	        'activated' => true
	    ));

	    $user->first_name = Input::get('first_name');
	    $user->last_name = Input::get('last_name');

	    $user->update();

		return Redirect::to('users/index')->with('success','Hey! User has been added successfully');

	}

	public function getEdituser($id){

		$user = User::find($id);

		return View::make('admin.edit_user')->with('title','Foldagram - Admin')
		->with("page_title","Manage User")
		->with('user',$user);
	}

	public function postEdituser()
	{

		try{
			$user = Sentry::findUserById( Input::get('id') );

			if(Input::get('password')!=''){
				$user->password = Input::get('password');
			}

			$user->first_name = Input::get('first_name');
			$user->last_name = Input::get('last_name');

			if($user->save())
			{
				return Redirect::to('users/index')->with('success','Hey! User info has been updated successfully');
			}else{
				return Redirect::to('users/index')->with('error','Unable to save user');
			}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users/index')->with('error','Unable to find user');
		}

	}

	public function getDelete($id=null)
	{
		try
		{
	 		$user = Sentry::findUserById($id);
			$delete = $user->delete();

		    if ($delete)
		    {
		        return Redirect::to('users/index')->with('success', 'User has been deleted successfully.');
		    }
		    else
		    {
		        return Redirect::to('users/index')->with('error',"User not deleted, please try again")->with("title","The Foldagram - Admin");
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users/index')->with('error','Unable to find user');
		}
	}

	public function getBlock($id=null)
	{
		try{
			$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->Ban();
			return Redirect::to('users/index')->with('success','User has been blocked successfully.');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    return Redirect::to('users/index')->with('error','Unable to Block user');
		}

	}

	public function getActive($id=null)
	{
		try
	    {
	    	$throttle = Sentry::findThrottlerByUserId($id);
			$throttle->unBan();
	        return Redirect::to('users/index')->with('success','User has been Activated successfully.');
	    }
	    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	    {
	        return Redirect::to('users/index')->with('error','Unable to Activate user');
	    }

	}



}