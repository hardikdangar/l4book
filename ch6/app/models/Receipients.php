<?php

class Recipients extends Eloquent{

    protected $table = 'foldagram_reff_address';
    protected $guarded = array();

    public function foldagram()
    {
         return $this->belongsTo('Foldagram');
    }

}