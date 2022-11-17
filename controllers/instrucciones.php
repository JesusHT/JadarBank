<?php

    class Instrucciones extends Controller {

        function __construct(){
            parent::__construct();
            $this -> redirectRole();

            if (!isset($_SESSION['accion'])) {
                $this -> redirect('main');
                return;
            }

            $this -> view -> render('instrucciones/index');
        }

        function volver(){
            unset($_SESSION['accion']);
            $this -> redirect('main');
        }
    }
?>