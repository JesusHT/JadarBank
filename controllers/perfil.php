<?php

    class Perfil extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('perfil/index');
        }
    }

?>