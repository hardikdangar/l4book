<?php

class FoldagramController extends BaseController {

	public function create()
	{

		// save the message first
		$foldagram = new Foldagram;
		$foldagram->message = Input::get('message');
		$foldagram->save();

		//resize and update image path
		if (Input::hasFile('image'))
		{

			$filename = $foldagram->id."_".str_random(8). '.' . File::extension(Input::file('image')->getClientOriginalName());

			$destinationPath = 'img/uploads/';
			$thumnailPath = 'img/thumbnails/'.$filename;

			Input::file('image')->move($destinationPath, $filename);
			Image::make($destinationPath.$filename)->resize(100, 100)->save($thumnailPath);

			$foldagram->image = $filename;
			$foldagram->save();
		}


		//save recipient information
		$recipients_input = Input::get('add');
		if(!empty($recipients_input)){
		  foreach($recipients_input as $value){

		    $recipient = new Recipients(
		    		 array(
					      'fullname'=>$value['fullname'],
					      'address_one'=>$value['address_one'],
					    )
		    	);
		    $foldagram->recipients()->save($recipient);
		  }
		}

		//Add Foldagram Details to our Cart Package
		try{

			$qty = count(Input::get('add'));

			$item = array(
				'id'      => 'sku_foldagram_'.$foldagram->id,
				'qty'     => $qty,
				'price'   => Config::get('foldagram.price'),
				'name'    => 'Foldagram',
				'options' => array('id'=>$foldagram->id)
			);
			// Add the item to the shopping cart.
			Cart::insert($item);

			// Redirect to the cart page.
			return Redirect::to('/')
			->with('dsuccess',"Your Foldagram Has Saved")
			->with('redirect',"preview")
			->with('class','home');

			} catch(Exception $e) {

				return Redirect::to('/')->with('error', $e->getMessage() );
			}

			catch (Cart\CartInvalidDataException $e)
			{
				return Redirect::to('/')->with('error', 'Invalid data passed.');
			}

			catch (Cart\CartInvalidItemQuantityException $e)
			{
				return Redirect::to('/')->with('error', 'Invalid item quantity.');
			}

			catch (Cart\CartInvalidItemRowIdException $e)
			{
				return Redirect::to('/')->with('error', 'Invalid item row id.');
			}

			catch (Cart\CartInvalidItemNameException $e)
			{
				return Redirect::to('/')->with('error', 'Invalid item name.');
			}

			catch (Cart\CartInvalidItemPriceException $e)
			{
				return Redirect::to('/')->with('error', 'Invalid item price.');
			}



	}

	public function edit(){

		$foldagram_id = Input::get('foldagram_id');

		if(!$foldagram_id){
			Redirect::to('/');
		}

		$reff_adress = Input::get('add');
		$foldagram_data = Foldagram::find($foldagram_id);

		//if user has changed save the message
		$foldagram_data->message = Input::get('message');
		$foldagram_data->save();

		//check if user has uploaded new image and change if user has
		 if (Input::hasFile('image')) {
			$filename = $foldagram->id."_".str_random(8). '.' . File::extension(Input::file('image')->getClientOriginalName());

			$destinationPath = 'img/uploads/';
			$thumnailPath = 'img/thumbnails/'.$filename;

			Input::file('image')->move($destinationPath, $filename);
			Image::make($destinationPath.$filename)->resize(100, 100)->save($thumnailPath);

			$foldagram->image = $filename;
			$foldagram->save();

			@unlink(public_path().'/img/uploads/'.$foldagram_data->image);
			@unlink(public_path().'/img/thumbnails/'.$foldagram_data->image);
		 }

		$ref_count = 0;
		//save recipient information
		$recipients_input = Input::get('add');
		if(!empty($recipients_input)){
		  foreach($recipients_input as $value){

		    $recipient = new Recipients(
		    		 array(
					      'fullname'=>$value['fullname'],
					      'address_one'=>$value['address_one'],
					    )
		    	);
		    $foldagram_data->recipients()->save($recipient);
		    $ref_count++;
		  }
		}



		if($ref_count>0)
		{
			$qty = count($ref_count);

			if(!empty($qty)){

				$item[] = array(
					'rowid' => Input::get('rowid'),
					'qty'   => (Input::get('qty') + $qty),
					'price'   => Config::get('foldagram.price'),
				);

				Cart::update($item);
			}
		}



		return Redirect::to('/')
							->with('dsuccess',"Your Foldagram has been updated.")
							->with('class','home')
							->with('redirect',"preview");

	}

	public function updateraddress()
	 {
	 	if(Input::get('rid')){

	 	   $raddress = Recipients::find(Input::get('rid'));
	 	   $raddress->fullname = Input::get('fullname');
	 	   $raddress->address_one= Input::get('address');

	 	   if($raddress->save()){
	 	   	  echo "<strong>".$raddress->fullname."</strong><br/>";
	 	   	  $text = preg_replace("/[\r\n]+/", "\n", $raddress->address_one);
	 	   	  $text = wordwrap($text,120, '<br/>', true);
			  echo $text = nl2br($text);
		   }else {
	 	   	 echo "not saved";
	 	   }
	 	   exit(0);
	 	}
	  }


	public function removeddress($id='', $rowid='')
	{
		if(empty($id) && empty($rowid)){
			return Redirect::to('/')
  			  ->with('dsuccess',"Foldagram Recipient Address not found.")
			->with('redirect',"preview");
		}

		try
			{
			   if(Cart::total_items()>1){

					   $raddress = Recipients::where('id','=', $id)->delete();

					   if($raddress){

					   	$total_item = Cart::total_items();

						$total_item  = $total_item-1;



					// Get the items to be updated.
					if(!empty($total_item)){

							$item[] = array(
							'rowid' => $rowid,
							'qty'   => ($total_item),
							'price'   => Config::get('foldagram.price'),
						);

						Cart::update($item);
							// Redirect to the cart page.
						return Redirect::to('/')
						->with('dsuccess',"The Foldagram Recipient Address has been removed")
						->with('redirect',"preview");

					 }else {
					 		return Redirect::to('/')
					->with('derror',"At least one Recipient Address Requied.")
					->with('redirect',"preview");
					 }

				   }else {
					   	return Redirect::to('/')
					->with('derror',"Recipient Address not found.")
					->with('redirect',"preview");
				   }

			  }else {
				 	return Redirect::to('/')
					->with('derror',"In Foldagram at least one Recipient Address Requied.")
					->with('redirect',"preview");
				 }

			}

			// Is the Item Row ID valid?
			//
			catch (Cartify\CartInvalidItemRowIdException $e)
			{
				// Redirect back to the shopping cart page.
				//
				return Redirect::to('/')->with('perror', 'Invalid Item Row ID!')->with('class','home');
			}

			// Does this item exists on the shopping cart?
			//
			catch (Cartify\CartItemNotFoundException $e)
			{
				// Redirect back to the shopping cart page.
				//
				return Redirect::to('/')->with('perror', 'Item was not found in your shopping cart!')->with('class','home');
			}

			// Is the item quantity valid?
			//
			catch (Cartify\CartInvalidItemQuantityException $e)
			{
				// Redirect back to the shopping cart page.
				//
				return Redirect::to('/')->with('perror', 'Invalid item quantity!')->with('class','home');
			}

	 }


}