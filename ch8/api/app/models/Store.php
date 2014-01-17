<?php

class Store extends Eloquent {

    protected $table = 'stores';
    protected $hidden = array('created_at','updated_at');

}