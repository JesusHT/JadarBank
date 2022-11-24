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

            $this -> view -> render('ver/index',[
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

        public function desglose(){
            if ($this -> existGET(['v'])) {
                if ($this -> validateData(['v'])){
                    $Loan = new LoanModel();
                    
                    $Loan -> ExistLoan($_GET['v']);

                    $data = $Loan -> calDatePayments();

                    $this -> loan($data);

                }
            }
        }

        function loan($data){
            $this -> view -> render("templates/desglose",[
                "loan" => $data
            ]);
        }

        public function volver(){
            unset($_SESSION['ver']);
            $this -> redirect('admin');
        }
        
        function cerrar(){$this -> redirect("ver");}
    }

?>