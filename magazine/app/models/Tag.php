<?php

/**
 * Model, ktorý je naviazaný na tabuľku tags
 */
class Tag extends Eloquent {

    public $timestamps = false;
    protected $table = 'tags';
    protected $fillable = array('id_tag', 'id_article');

    /**
     * Vráti model popisu kľučového slova
     * @return type
     */
    public function tagDescription() {
        return $this->hasOne('Tag_group', 'id', 'id_tag');
    }

    /**
     * Vráti model článku, na ktorý je kľúčove slovo naviazané
     * @return type
     */
    public function articles() {
        return $this->hasOne('Article', 'id', 'id_article');
    }

}
