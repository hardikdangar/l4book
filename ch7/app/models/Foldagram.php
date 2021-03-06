<?php

class Foldagram extends Eloquent{

	protected $table = 'foldagram';
	protected $guarded = array();

	public function recipients()
	{
		return $this->hasmany('Recipients','foldaram_id','id');
	}

	public function orders(){
		return $this->hasmany('orders','foldaram_id','id');
	}

}