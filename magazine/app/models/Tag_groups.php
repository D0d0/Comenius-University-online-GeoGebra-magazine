<?php

class Tag_groups extends Eloquent {

    protected $table = 'tag_groups';
    protected $fillable = array('name', 'count');

    public function tag() {
        return $this->belongsTo('Tags', 'id', 'id_tag');
    }

}
