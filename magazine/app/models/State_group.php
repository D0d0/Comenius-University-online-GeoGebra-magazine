<?php

class State_group extends Eloquent {

    protected $table = 'state_groups';
    protected $fillable = array('description');

    public function article() {
        return $this->belongsTo('Article', 'id', 'state');
    }

}
