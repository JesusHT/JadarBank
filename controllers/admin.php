<?php

    class Admin extends Controller {

        function __construct(){
            parent::__construct();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $tabla = $this -> tableUsers();
            $this -> view -> render('admin/index', ['tabla' => $tabla]);
        }

        function tableUsers(){
            $query = new UserModel();
            if ($this -> existPOST(['busqueda'])) {
                $busqueda = $this -> getPost('busqueda');
                return $query -> busqueda($busqueda, $_SESSION['user']);
            }

            return $query -> tableUsers($_SESSION['user']);
        }

        function delete(){

        }

        function update(){

        }

        function ver(){
            
        }
    }

?>