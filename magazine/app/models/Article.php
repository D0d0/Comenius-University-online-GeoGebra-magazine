<?php

/**
 * Model pre tabuľku articles
 */
class Article extends Eloquent {

    const DRAFT = 1;
    const SENT = 2;
    const ACCEPTED = 3;
    const UNAPROVED = 4;
    const PUBLISHED = 5;

    protected $table = 'articles';
    protected $fillable = array('user_id', 'state', 'title', 'image', 'abstract', 'text', 'updated_at', 'created_at');

    /**
     * Vráti model stavu článku
     * @return type
     */
    public function state() {
        return $this->hasOne('State_group', 'id', 'state');
    }

    /**
     * Vráti model užívateľa, ktorý článok napísal
     * @return type
     */
    public function user() {
        return $this->hasOne('User', 'id', 'user_id');
    }

    /**
     * Vráti modely kľúčových slov článku
     * @return type
     */
    public function tags() {
        return $this->hasMany('Tag', 'id_article', 'id');
    }

    public function review(){
        return $this->hasOne('Review', 'id_article', 'id');
    }

    /**
     * Zoberie z db len tie články, ktoré sú konceptom
     * @param type $query
     * @return type
     */
    public function scopeDraft($query) {
        return $query->where('state', '=', self::DRAFT);
    }

    /**
     * Zoberie z db len tie články, ktoré sú odoslané na recenzovanie
     * @param type $query
     * @return type
     */
    public function scopeSent($query) {
        return $query->where('state', '=', self::SENT);
    }

    /**
     * Zoberie z db len tie články, ktoré sú akceptované od recenzenta
     * @param type $query
     * @return type
     */
    public function scopeAccepted($query) {
        return $query->where('state', '=', self::ACCEPTED);
    }

    /**
     * Zoberie z db len tie články, ktoré sú neschválené od recenzenta
     * @param type $query
     * @return type
     */
    public function scopeUnaproved($query) {
        return $query->where('state', '=', self::UNAPROVED);
    }

    /**
     * Zoberie z db len tie články, ktoré sú už publikované
     * @param type $query
     * @return type
     */
    public function scopePublished($query) {
        return $query->where('state', '=', self::PUBLISHED);
    }

    /**
     * Vráti formátovaný čas vytvorenia článku
     * @return type
     */
    public function getFormattedCreatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['created_at']));
    }

    /**
     * Vráti formátovaný čas poslednej úpravy článku
     * @return type
     */
    public function getFormattedUdatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }

}
