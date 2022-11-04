<?php

    class Ayuda extends Controller {

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('ayuda/index');
        }
    }
    
?>