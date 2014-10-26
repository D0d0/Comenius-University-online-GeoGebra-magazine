<?php

class User_group extends Eloquent {

    protected $table = 'user_groups';
    protected $fillable = array('description');

    public function user() {
        return $this->belongsTo('User');
    }

}
