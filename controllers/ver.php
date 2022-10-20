<?php

    class Ver extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('ver/index');
        }
    }

?>