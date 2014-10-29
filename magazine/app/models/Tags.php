<?php

class Tags extends Eloquent {

    protected $table = 'tags';
    protected $fillable = array('id_tag', 'id_article');

    public function group() {
        return $this->hasOne('Tag_groups', 'id', 'id_tag');
    }

    public function user() {
        return $this->hasMany('Article', 'id', 'id_article');
    }

}
