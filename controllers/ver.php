<?php

    class Ver extends Controller {
        private $cliente;

        function __construct(){
            parent::__construct();

            if (!isset($_POST['ver'])) {
                $this->redirect('admin');
                return;
            }
            
            $query = new UserModel();
            $this -> cliente = $query -> get($_POST['ver']);
            $this -> view -> render('admin/ver', ['client' => $this -> cliente]);
        }
    }

?>