<?php

class Controller
{
    public function view($path, $data = [])
    {
        if (file_exists("../app/views/" . $path . ".php")) {
            include "../app/views/" . $path . ".php";
        }
    }

    public function load_model($model)
    {
        if (file_exists("../app/models/" . strtolower($model) . ".model.php")) {
            include "../app/models/" . strtolower($model) . ".model.php";
            return $model = new $model();
        }
        return false;
    }
}
