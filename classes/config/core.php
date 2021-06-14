<?php

class core
{
    public static $home_url="http://rocmn.markkors.nl/save_login/";

    public static function init() {
        // show error reporting
        error_reporting(E_ALL);

        // start php session
        session_start();

        // set your default time-zone
        date_default_timezone_set('Europe/Amsterdam');
    }

}