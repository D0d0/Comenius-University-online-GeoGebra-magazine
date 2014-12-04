<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Model pre tabuľku users
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    const ADMIN = 1;
    const REDACTION = 2;
    const REVIEWER = 3;
    const USER = 4;
    
    const NOT_BANNED = 0;
    const BANNED = 1;

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
    protected $fillable = array('name', 'password', 'email', 'image', 'birth', 'city', 'school', 'google', 'facebook', 'twitter', 'language', 'updated_at', 'created_at', 'about', 'confirmed', 'confirmation_code', 'ban');

    /**
     * Vráti všetky modely článku, ktoré patria užívateľovi
     * @return type
     */
    public function articles() {
        return $this->hasMany('Article', 'user_id', 'id');
    }

    /**
     * Vráti všetky modely používateľský rolý, ktoré má užívateľ
     * @return type
     */
    public function roles() {
        return $this->hasMany('UserRole', 'user_id', 'id');
    }

    /**
     * Zistí, či užívateľ má zadanú užívateľskú rolu
     * @param type $id
     * @return boolean
     */
    public function hasRank($id) {
        foreach ($this->roles()->get() as $rank) {
            if ($rank->rank_id == $id) {
                return true;
            }
        }
        return false;
    }
    
    public function isBanned(){
        return $this->ban == User::BANNED;
    }

    /**
     * Vráti formátovaný čas narodenia užívateľa
     * @return type
     */
    public function getFormattedBirth() {
        return date('j.n.Y', strtotime($this->getAttributes()['birth']));
    }

    /**
     * Vráti formátovaný čas vytvorenia užívateľa
     * @return type
     */
    public function getFormattedCreatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['created_at']));
    }

    /**
     * Vráti formátovaný čas poslednej úpravy užívateľa
     * @return type
     */
    public function getFormattedUdatedAt() {
        return date('j.n.Y', strtotime($this->getAttributes()['updated_at']));
    }

}
