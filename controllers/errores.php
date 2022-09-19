<?php

    class Errores extends Controller {

        function __construct(){
            parent::__construct();
            $this -> view -> mensaje = 'Recurso no encontrado!';
            $this -> view -> render('error/index');
        }
    }

?>