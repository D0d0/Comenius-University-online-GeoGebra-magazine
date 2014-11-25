<?php

/**
 * Model pre tabuľku user_roles
 */
class UserRole extends Eloquent {

    protected $table = 'user_roles';
    protected $fillable = array('rank_id', 'user_id');

}
