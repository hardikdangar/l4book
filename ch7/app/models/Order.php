<?php

class Order extends Eloquent{

	protected $table = 'orders';
	protected $guarded = array();

    public function foldagram()
    {
         return $this->belongsTo('Foldagram');
    }

}