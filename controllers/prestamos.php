<?php

    class Prestamos extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('prestamos/index');
        }
    }

?>