<?php

class StoreController extends \BaseController {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/

	public function index()
	{

		$city = Input::get('city');
		$country = Input::get('country');
		$zip = Input::get('zip');

		if( $city == '' && $country == '' && $zip == ''){
			$stores = Store::all();
		}else{
			$stores = DB::table('store')
					->where('city','LIKE',"%$city%")
					->or_where('country','LIKE',"%$country%")
					->or_where('zip','=',"$zip")
					->get();
		}

		$result = array(
			        'error' => false,
			        'stores' => $stores->toArray()
		        );

		return Response::json($result,200)->setCallback(Input::get('callback'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	    $store = new Store;

	    $store->name = Request::get('name');
	    $store->address = Request::get('address');
	    $store->city = Request::get('city');
	    $store->zip = Request::get('zip');
	    $store->country = Request::get('country');
	    $store->latitude = Request::get('latitude');
	    $store->longitude = Request::get('longitude');
	    $store->support_phone = Request::get('support_phone');
	    $store->support_email = Request::get('support_email');
	    $store->user_id = Auth::user()->id;

	    if( $store->save() ){

	        $result = array(
				            'error' => false,
				            'msg' => 'store created successfully.'
				      );

	        return Response::json($result,200)->setCallback(Input::get('callback'));

	    }else{

			$result = array(
			            'error' => true,
			            'msg' => 'issue creating store!'
				      );

	        return Response::json($result,200)->setCallback(Input::get('callback'));

	    }


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$store = Store::find($id);

		$result = array(
			        'error' => false,
			        'stores' => $store->toArray()
		        );

	    return Response::json($result,200)->setCallback(Input::get('callback'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
	    $store = Store::find($id);

	    $store->name = Request::get('name');
	    $store->address = Request::get('address');
	    $store->city = Request::get('city');
	    $store->zip = Request::get('zip');
	    $store->country = Request::get('country');
	    $store->latitude = Request::get('latitude');
	    $store->longitude = Request::get('longitude');
	    $store->support_phone = Request::get('support_phone');
	    $store->support_email = Request::get('support_email');
	    $store->user_id = Auth::user()->id;

	    if( $store->save() ){

	        $result = array(
		            'error' => false,
		            'msg' => 'store has been updated'
	        	);

	        return Response::json($result,200)->setCallback(Input::get('callback'));

	    }else{

	        $result =  array(
	            'error' => true,
	            'msg' => 'issue updating store!'
	        );

	        return Response::json($result,200)->setCallback(Input::get('callback'));

	    }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $store = Store::find($id);
	 	 if(!empty($store))
	    $store->delete();

	    $result = array(
		        'error' => false,
		        'msg' => 'Store deleted'
	        );

	    return Response::json($result,200)->setCallback(Input::get('callback'));

	}

}