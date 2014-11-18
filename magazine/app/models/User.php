<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    const ADMIN = 1;
    const REDACTION = 2;
    const REVIEWER = 3;
    const USER = 4;

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
    protected $fillable = array('name', 'password', 'email', 'image', 'birth', 'city', 'school', 'google', 'facebook', 'twitter', 'language', 'updated_at', 'created_at', 'about', 'confirmed', 'confirmation_code');

    public function articles() {
        return $this->belongsTo('Article', 'user_id', 'id');
    }

    public function roles() {
        return $this->hasMany('UserRole', 'user_id', 'id');
    }

    public function hasRank($id) {
        foreach ($this->roles()->get() as $rank) {
            if ($rank->rank_id == $id) {
                return true;
            }
        }
        return false;
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
