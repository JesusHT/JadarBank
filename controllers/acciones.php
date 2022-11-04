<?php

    class Acciones extends Controller {

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('acciones/index');
        }
    }
    
?>