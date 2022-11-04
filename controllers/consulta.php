<?php

    class Consulta extends Controller {

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('consulta/index');
        }
    }
    
?>