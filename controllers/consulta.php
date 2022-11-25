<?php

    class Consulta extends Controller {

        private $customer;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            
            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> customer = new UserModel();
            $this -> customer -> getUsers($_SESSION['user']);

            $this -> view -> render('consulta/index',[
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

        function pagar(){
            if ($this -> existPOST(['num_prestamo'])) {
                $Loan = new LoanModel();
                $Loan -> ExistLoan($_POST['num_prestamo']);

                if($Loan -> aviso($this -> customer -> getNum_client())){
                    
                }

                $this -> view -> render("templates/pagos");
            }

            $this -> cerrar();

        }
        
        function loan($data){
            $this -> view -> render("templates/desglose",["loan" => $data]);
        }

        function payment($data){
            $this -> view -> render("templates/pagos",["payment" =>$data]);
        }
        
        function cerrar(){$this -> redirect("consulta");}
    }
    
?>