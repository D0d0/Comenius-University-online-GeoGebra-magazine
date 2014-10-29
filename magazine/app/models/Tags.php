<?php

class Tags extends Eloquent {

    protected $table = 'tags';
    protected $fillable = array('id_tag', 'id_article');

    public function description() {
        return $this->hasOne('Tag_groups', 'id', 'id_tag');
    }

    public function article() {
        return $this->belongsTo('Article', 'id_article', 'id');
    }

}
