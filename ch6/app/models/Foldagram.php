<?php

class Foldagram extends Eloquent{

	protected $table = 'foldagram';
	protected $guarded = array();

	public function recipients()
	{
		return $this->hasmany('Recipients','foldaram_id','id');
	}


}