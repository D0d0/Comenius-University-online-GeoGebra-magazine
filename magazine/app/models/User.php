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
    protected $hidden = array('password', 'token');
    protected $fillable = array('name', 'email', 'rank', 'image', 'birth', 'city', 'school', 'google', 'facebook', 'twitter', 'language', 'updated_at', 'created_at ', 'about');

    public function rank() {
        return $this->hasOne('User_group', 'id', 'rank');
    }

}
