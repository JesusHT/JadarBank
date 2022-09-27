<?php

    class Prestamos extends Controller {
        
        function __construct(){
            parent::__construct();
        }

        function render(){
            $this -> view -> render('prestamo/index');
        }
    }

?>