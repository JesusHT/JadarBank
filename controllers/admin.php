<?php

    class Admin extends Controller {

        function __construct(){
            parent::__construct();
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $tabla = $this -> tableUsers();
            $this -> view -> render('admin/index', ['tabla' => $tabla]);
        }

        function tableUsers(){
            $query = new UserModel();

            if ($this -> existPOST(['busqueda'])) {
                $busqueda = $this -> getPost('busqueda');
                return $query -> tableUsers($busqueda, $_SESSION['user']);
            }

            return $query -> tableUsers(NULL,$_SESSION['user']);
        }

        function delete(){
            
            header('Content-Type: application/json');
            
            if ($this -> existPOST(['passEjecutivo','eliminar'])) {
                $data = "Hola!";
                echo json_encode($data);
            }
        }

        function update(){

        }
    }

?>