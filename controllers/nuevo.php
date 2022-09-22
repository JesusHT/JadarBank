<?php

    class Nuevo extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('nuevo/index');
        }

        function registrarCliente(){
            echo 'Alumno Creado';
            $this -> model -> insert();
        }
    }

?>