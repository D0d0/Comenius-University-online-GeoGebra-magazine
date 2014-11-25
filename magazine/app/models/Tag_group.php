<?php

/**
 * Model pre tabuľku tag_groups
 */
class Tag_group extends Eloquent {

    public $timestamps = false;
    protected $table = 'tag_groups';
    protected $fillable = array('name', 'count');

}
