<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');
    protected $fillable = array('name', 'password', 'email', 'rank', 'image', 'birth', 'city', 'school', 'google', 'facebook', 'twitter', 'language', 'updated_at', 'created_at', 'about', 'confirmed', 'confirmation_code');

    public function rank() {
        return $this->hasOne('User_group', 'id', 'rank');
    }

    public function articles() {
        return $this->belongsTo('Article');
    }
    
    public function scopeAdmin($query) {
        return $query->where('rank', '=', 1);
    }

    public function scopeRedaction($query) {
        return $query->where('rank', '=', 2);
    }

    public function scopeReviewer($query) {
        return $query->where('rank', '=', 3);
    }

    public function scopeUser($query) {
        return $query->where('rank', '=', 4);
    }
    
    public function getFormattedBirth() {
        return date('j.n.Y', strtotime($this->getAttributes()['birth']));
    }
    
    public function getFormattedCreatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }
    
    public function getFormattedUdatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }
    

}
