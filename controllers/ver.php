<?php

    class Ver extends Controller {
        private $cliente;

        function __construct(){
            parent::__construct();
            $query = new UserModel();
            $this -> cliente = $query -> get($_POST['ver']);
            $this -> view -> render('ver/index', ['client' => $this -> cliente]);
        }
    }

?>