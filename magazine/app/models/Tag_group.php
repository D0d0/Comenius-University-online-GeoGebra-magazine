<?php

class Tag_group extends Eloquent {

    protected $table = 'tag_groups';
    protected $fillable = array('name', 'count');

    public function tag() {
        return $this->belongsTo('Tag', 'id', 'id_tag');
    }

}
