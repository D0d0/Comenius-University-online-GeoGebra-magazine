<?php

class Reviews extends Eloquent {

    protected $table = 'reviews';
    protected $fillable = array('id_article', 'reviewer_id', 'text', 'created_at', 'updated_at');

    public function article() {
        return $this->hasOne('Article', 'id', 'id_article');
    }

    public function reviewer() {
        return $this->hasOne('User', 'id', 'reviewer_id');
    }

}
