<?php

    class Perfil extends Controller {
        
        function __construct(){
            parent::__construct();
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $query = new UserModel();
            $this -> cliente = $query -> get($_SESSION['user']);
            $this -> view -> render('perfil/index', ['client' => $this -> cliente]);
        }
    }

?>