<?php

    class Editar extends Controller{
        private $cliente;

        function __construct(){
            parent::__construct();

            if (!isset($_POST['actualizar'])) {
                $this->redirect('admin');
                return;
            }
            
            $query = new UserModel();
            $this -> cliente = $query -> get($_POST['actualizar'], NULL);
            $this -> view -> render('admin/editar', ['client' => $this -> cliente]);
        }
    }

?>