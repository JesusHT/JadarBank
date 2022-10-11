<?php

    class Consulta extends Controller {
        
        function __construct(){
            parent::__construct();
        }

        function render(){
            $this -> view -> render('consulta/index');
        }
    }

?>