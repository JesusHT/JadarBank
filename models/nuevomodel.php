<?php

    class NuevoModel extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function insert(){
            echo 'Insertar Datos';
        }

        public function update(){
            echo 'Actualizar datos';
        }
    }

?>