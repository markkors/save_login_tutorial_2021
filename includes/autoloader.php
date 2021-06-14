<?php

spl_autoload_register(function ($class_name) {
    //class directories

    $source = $_SERVER['DOCUMENT_ROOT'] . '/save_login/';
    $dirs = [
        $source.'/classes/',
        $source.'/classes/config/',
        $source.'/classes/objects/'
    ];
    foreach($dirs as $directory)
    {
        //echo $directory.$class_name . '.php<br>';
        //see if the file exsists
        if(file_exists($directory.$class_name . '.php'))
        {
            require($directory.$class_name . '.php');
        }
    }
});



