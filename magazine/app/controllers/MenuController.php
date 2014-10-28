<?php

class MenuController extends Controller {

    public function getOnas() {
        return View::make('onas');
    }

    public function getKontakt() {
        return View::make('kontakt');
    }

    public function getProfile() {
        return View::make('profile.profile');
    }

}
