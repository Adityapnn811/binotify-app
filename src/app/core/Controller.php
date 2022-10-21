<?php
    class Controller {
        // panggil view yang bersangkutan
        public function view($view, $data = []) {
            require_once '../app/views/' . $view . '.php';
        }

        public function model($model){
            require_once '../app/models/' . $model . '.php';
            return new $model;
        }
    }
?>