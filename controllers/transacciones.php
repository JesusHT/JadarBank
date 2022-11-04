<?php

    class Transacciones extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('transacciones/index');
        }
    }
?>