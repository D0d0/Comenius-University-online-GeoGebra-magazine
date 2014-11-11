<?php

class Tag_group extends Eloquent {

    public $timestamps = false;
    protected $table = 'tag_groups';
    protected $fillable = array('name', 'count');

}
