<?php
    class Admin extends Controller {

        function __construct(){
            parent::__construct();
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }
            
            $tabla   = $this -> tableUsers();
            $paginas = $this -> getPages();

            $this -> view -> render('admin/index', [
                'tabla' => $tabla,
                'page' => $paginas
            ]);
        }

        function tableUsers(){
            $query = new TableUsersModel();

            if ($this -> existPOST(['busqueda'])) {
                $busqueda = $this -> getPost('busqueda');
                return $query -> getTableUsers($busqueda, $_SESSION['user']);
            }

            return $query -> getTableUsers(NULL,$_SESSION['user']);
        }

        function getPages(){
            $query = new TableUsersModel();

            if ($this -> existPOST(['busqueda']) && !empty($_POST['busqueda'])) {
                return NULL;
            }

            return $query -> mostrarPaginas();
        }

        function delete(){
            
            if ($this -> existPOST(['passEjecutivo','eliminar'])) {
                
                if ($this -> validateData(['passEjecutivo','eliminar'])) {
                    $this->redirect('admin', ['error' => Errors::ERROR_ADMIN_DELETEUSER_DATA ]);
                    return;
                }

                $pass = $this -> getPost('passEjecutivo');
                $id   = $this -> getPost('eliminar');

                $query = new UserModel();

                if ($query->comparePasswords($pass,$_SESSION['user'])) {
                    $query->delete($id);
                    $this->redirect('admin', ['success' =>  Success::SUCCESS_ADMIN_DELETEUSER ]);
                    return;
                }

                $this->redirect('admin', ['error' => Errors::ERROR_ADMIN_DELETEUSER_PASS]);
            }
        }
    }

?>