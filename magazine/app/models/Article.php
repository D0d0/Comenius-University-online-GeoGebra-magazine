<?php

class Article extends Eloquent {

    protected $table = 'article';
    protected $fillable = array('user_id', 'state', 'title', 'image', 'abstract', 'text', 'updated_at', 'created_at');

    public function state() {
        return $this->hasOne('State_group', 'id', 'state');
    }

    public function user() {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function tags() {
        return $this->hasMany('Tags', 'id_article', 'id');
    }

}
