<?php

class Article extends Eloquent {

    const DRAFT = 1;
    const SENT = 2;
    const ACCEPTED = 3;
    const UNAPROVED = 4;
    const PUBLISHED = 5;

    protected $table = 'articles';
    protected $fillable = array('user_id', 'state', 'title', 'image', 'abstract', 'text', 'updated_at', 'created_at');

    public function state() {
        return $this->hasOne('State_group', 'id', 'state');
    }

    public function user() {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function tags() {
        return $this->hasMany('Tag', 'id_article', 'id');
    }

    public function scopeDraft($query) {
        return $query->where('state', '=', self::DRAFT);
    }

    public function scopeSent($query) {
        return $query->where('state', '=', self::SENT);
    }

    public function scopeAccepted($query) {
        return $query->where('state', '=', self::ACCEPTED);
    }

    public function scopeUnaproved($query) {
        return $query->where('state', '=', self::UNAPROVED);
    }

    public function scopePublished($query) {
        return $query->where('state', '=', self::PUBLISHED);
    }

    public function getFormattedCreatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['created_at']));
    }

    public function getFormattedUdatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }

}
