<?php

    class Consulta extends Controller {

        private $loan;
        private $customer;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            
            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> customer = new UserModel();
            $this -> customer -> getUsers($_SESSION['user']);
            $this -> loan     = new LoanModel();

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
                    $this -> loan -> ExistLoan($_GET['v']);
                    $data = $this -> loan -> calDatePayments($_GET['v']);

                    $this -> loan($data);
                }
            }
        }

        public function pagar(){

        }

        public function pagos(){
            $data = $this -> loan -> calPayment($_POST['num_prestamo']);

            $this -> payment($data,$_POST['num_prestamo']);
        }
        
        function loan($data){
            $this -> view -> render("templates/desglose",["loan" => $data]);
        }

        function payment($data, $num_prestamo){
            $this -> view -> render("templates/pagos",[
                "payment" =>$data,
                "num_prestamo" => $num_prestamo
            ]);
        }

        function decimales($value){return number_format($value, 2, '.', '');}
        
        function cerrar(){$this -> redirect("consulta");}
    }
    
?>