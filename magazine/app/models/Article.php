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

    public function scopeDraft($query) {
        return $query->where('state', '=', 1);
    }

    public function scopeSent($query) {
        return $query->where('state', '=', 2);
    }

    public function scopeAccepted($query) {
        return $query->where('state', '=', 3);
    }

    public function scopeUnaproved($query) {
        return $query->where('state', '=', 4);
    }

    public function scopePublished($query) {
        return $query->where('state', '=', 5);
    }

    public function getFormattedCreatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['created_at']));
    }

    public function getFormattedUdatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }

}
