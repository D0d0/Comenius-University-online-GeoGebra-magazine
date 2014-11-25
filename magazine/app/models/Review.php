<?php

/**
 * Model pre tabuľku reviews
 */
class Review extends Eloquent {

    protected $table = 'reviews';
    protected $fillable = array('id_article', 'reviewer_id', 'text', 'created_at', 'updated_at');

    /**
     * Vráti model článku, ktorý sa viaže na recenziu
     * @return type
     */
    public function article() {
        return $this->hasOne('Article', 'id', 'id_article');
    }

    /**
     * Vráti model užívateľa, ktorý napísal recenziu
     * @return type
     */
    public function reviewer() {
        return $this->hasOne('User', 'id', 'reviewer_id');
    }

}
