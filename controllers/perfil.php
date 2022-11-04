<?php

    class Perfil extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $query = new UserModel();
            $this -> cliente = $_SESSION['role'] !== 'admin' ? $query -> get($_SESSION['user'],NULL) : $query -> get($_SESSION['user'],TRUE);
            $this -> view -> render('perfil/index', ['client' => $this -> cliente]);
        }
    }

?>