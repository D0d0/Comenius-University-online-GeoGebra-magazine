<?php

/**
 * Model pre tabuľku state_groups
 */
class State_group extends Eloquent {

    protected $table = 'state_groups';
    protected $fillable = array('description');

    /**
     * Vráti článok, na ktorý je naviazaný stav článku
     * @return type
     */
    public function article() {
        return $this->belongsTo('Article', 'id', 'state');
    }

}
