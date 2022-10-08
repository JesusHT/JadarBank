<?php

    class Recuperar extends Controller {
        
        function __construct(){
            parent::__construct();
        }

        function render(){
            $this -> view -> render('recuperar/index');
        }
    }
?>