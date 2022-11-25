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
            $this -> loan = new LoanModel();

            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> view -> render('ver/index',[
                'client' => $this -> cliente,
                'tabla' => $tabla,
                'page' => $paginas,
                'aviso' => $this -> aviso()
            ]);
        }

        public function aviso(){
            $data = '';

            $client = new UserModel();
            $client -> getUsers($_SESSION['ver']);

            if ($this -> loan -> aviso($client -> getNum_client())) {
                $data = '<p class="bg-error">!Tiene un prestamo vencido pagalo pronto!</p>';
            } else if ($this -> loan -> aviso($client -> getNum_client()) === NULL){
                $data = '<p class="bg-warning">!Tiene un prestamo que esta proximo avencerse paga lo más antes posible!</p>';
            }

            return $data;
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
                    
                    $Loan -> existLoan($_GET['v']);

                    $data = $Loan -> calDatePayments($_GET['v']);

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