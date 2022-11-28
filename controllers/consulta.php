<?php

    class Consulta extends Controller {

        private $loan;
        private $customer;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            
            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> customer = new CustomersModel();
            $this -> loan     = new LoanModel();
            $this -> customer -> queryCustomer($_SESSION['user']);
            $this -> customer -> queryAccountForNumClient($this -> customer -> getNum_client());

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
                    $data = $this -> loan -> calDatePayments();

                    $this -> loan($data);
                }
            }
        }

        public function pagar(){
            if ($this -> existPOST(['pago', 'accion', 'num_prestamo'])) {
                $data = $this -> loan -> calPayment($_POST['num_prestamo']);

                if (!$data['pago'] == $_POST['pago'] || !$data['total'] == $_POST['pago']) {
                   $this -> redirect('consulta/pagos', ['error' => Errors::ERROR_LOAN_CANT]);
                }

                if($data['pago'] == $_POST['pago'] && $this -> customer -> getSaldo() >= $_POST['pago']){
                    if ($this -> loan -> pagarPrestamo($_POST['num_prestamo'], $_POST['accion'], $data['interes'], $_POST['pago'], $this -> customer -> getSaldo())) {
                        $this -> redirect('consulta', ['success' => Success::SUCCESS_LOAN_PAYMENT]);
                        return;
                    }
                } 

                if ($data['total'] == $_POST['pago'] && $this -> customer -> getSaldo() >= $_POST['pago']) {
                    if ($this -> loan -> pagarTotalPrestamo($_POST['num_prestamo'], $_POST['accion'], $data['interes'], $_POST['pago'], $this -> customer -> getSaldo())) {
                        $this -> redirect('consulta', ['success' => Success::SUCCESS_LOAN_PAGADO]);
                        return;
                    }
                }

                $this -> redirect('consulta/pagos', ['error' => Errors::ERROR_RETIRO]);
            }
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