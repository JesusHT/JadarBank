<?php

    class Controller {
        function __construct(){
            echo 'Controlador base';
            $this -> view = new View();
        }
    }

?>