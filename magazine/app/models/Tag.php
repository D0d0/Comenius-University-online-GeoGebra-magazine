<?php

class Tag extends Eloquent {

    public $timestamps = false;
    protected $table = 'tags';
    protected $fillable = array('id_tag', 'id_article');

    public function tagDescription() {
        return $this->hasOne('Tag_group', 'id', 'id_tag');
    }

    public function articles() {
        return $this->hasOne('Article', 'id', 'id_article');
    }

}
