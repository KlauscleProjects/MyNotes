<?php

/**
 * Base Controller
 * Loads the models and views
 */

class Controller
{
    public function __construct()
    {
    }

    //load model
    public function model($model)
    {
        //require model file
        require_once '../app/models/' . $model . '.php';

        //instantiate model
        return new $model();
    }

    //load view
    public function loadView($view, $data = [])
    {
        // check for the view file

        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}
