<?php

    class Ver extends Controller {
        private $cliente;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();

            if (!isset($_SESSION['ver'])) {
                $this -> redirect('admin');
                return;
            }
            
            $query = new UserModel();
            $this -> cliente = $query -> get($_SESSION['ver'],NULL);
            $this -> view -> render('admin/ver', ['client' => $this -> cliente]);
        }

        function generarprestamo(){
            if ($this -> existPOST(['prestamo'])) {
                $prestamo = $this -> getPost('prestamo');

                $_SESSION['prestamo'] = $prestamo;
                $this -> redirect('prestamos');
            }
        }

        public function volver(){
            unset($_SESSION['ver']);
            $this -> redirect('admin');
        }
    }

?>