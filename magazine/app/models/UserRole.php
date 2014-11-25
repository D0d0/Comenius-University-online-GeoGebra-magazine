<?php

/**
 * Model pre tabuľku user_roles
 */
class UserRole extends Eloquent {

    protected $table = 'user_roles';
    protected $fillable = array('rank_id', 'user_id');
    
    public function user(){
        $this->hasOne('User', 'id', 'user_id');
    }

}
