<?php

class State_group extends Eloquent {

    protected $table = 'state_groups';
    protected $fillable = array('description');

    public function user() {
        return $this->belongsTo('Article', 'id', 'state');
    }

}
