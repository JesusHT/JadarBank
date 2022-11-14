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
            
            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> view -> render('admin/ver',[
                'client' => $this -> cliente,
                'tabla' => $tabla,
                'page' => $paginas
            ]);
        }

        public function setTable(){
            $query = new TablePrestamosModel();
            return $query -> getTablePrestamos();
        }

        public function setPages(){
            $query = new TablePrestamosModel();
            return $query -> getPages();
        }

        public function generarprestamo(){
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