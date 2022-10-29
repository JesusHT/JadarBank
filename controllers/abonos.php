<?php

    class Abonos extends Controller {

        function __construct(){
            parent::__construct();
            $this -> view -> render('abonos/index');
        }
    }
    
?>