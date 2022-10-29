<?php

    class Transacciones extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('transacciones/index');
        }
    }
?>