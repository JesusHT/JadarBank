<?php
    include_once './Includes/Dompdf/vendor/autoload.php';
    require_once './Includes/phpqrcode/qrlib.php';
    use Dompdf\Dompdf;

    class Ver extends Controller {
        private $cliente;

        private $rute;
        private $tamp;
        private $level;
        private $frameSize;
        private $contenido;
        private $filename; 
        private $loan;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();

            if (!isset($_SESSION['ver'])) {
                $this -> redirect('admin');
                return;
            }
            
            $this -> cliente = new CustomersModel();
            $this -> cliente -> queryCustomer($_SESSION['ver']);
            $this -> cliente -> queryAccountForNumClient($this -> cliente -> getNum_client());

            $this -> loan = new LoanModel();

            $tabla   = $this -> setTable();
            $paginas = $this -> setPages();

            $this -> view -> render('ver/index',[
                'client' => ['num_client'  => $this -> cliente -> getNum_client(), 
                             'name'        => $this -> cliente -> getName(),
                             'img_client'  => $this -> cliente -> getImg_client(),
                             'num_cuenta'  => $this -> cliente -> getNum_cuenta()
                            ],
                'tabla' => $tabla,
                'page' => $paginas,
                'aviso' => $this -> aviso()
            ]);

            $this -> rute        = constant('URL-IMG');
            $this -> tamp        = 15;
            $this -> level       = 'H';
            $this -> frameSize   = 1;
            $this -> contenido   = '';
            $this -> movimientos = ["retiros", "tranferencias"];
        }

        public function aviso(){

            $client = new UserModel();
            $client -> getUsers($_SESSION['ver']);

            return $this -> loan -> aviso($client -> getNum_client());

        }

        function movimientos(){
            if ($this -> existGET(['v'])) {
                for ($i=0; $i < 2   ; $i++) {
                    if ($_GET['v'] === $this -> movimientos[$i]){
                        $this -> {$_GET['v']}();
                        return;
                    }
                }
                $this -> cerrar();
            }
        }

        function retiros(){
            $account = ['saldo'      => $this -> cliente -> getSaldo(), 
                        'num_client' => $this -> cliente -> getNum_client()
                    ];

            $this -> view -> render("ver/retiros",[
                "cuenta" => $account
            ]);
        }

        function tranferencias(){
            $account  = ['saldo' => $this -> cliente -> getSaldo(), 'num_client' => $this -> cliente -> getNum_client()];

            $this -> view -> render("ver/transferir",[
                "cuenta"    => $account
            ]);
        }

        function retiro(){
            if ($this -> existPOST(['num_client', 'cant', 'accion'])) {
                if ($this -> validateData(['num_client','cant'])) {
                    $this->redirect('ver/retiros', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }
                
                $cant       = $this -> getPost('cant');
                $num_client = $this -> getPost('num_client');

                if ($this -> cliente -> getSaldo() < $cant) {
                    $this->redirect('ver/retiros', ['error' => Errors::ERROR_MONEY_CANT]);
                    return;
                }

                $client = new UserModel();
                $client -> getUsers($_SESSION['user']);

                $this -> model -> updateSaldo($cant, $this -> cliente -> getSaldo(), $this -> cliente -> getNum_client());
                $this -> model -> generarMovimiento($_POST['accion'], $cant, "" , $client -> getNum_client());

                $this -> generateQR($num_client, $cant);

                $_SESSION['ruta']       = 'ver';
                $_SESSION['accion']     = 'Retiro';
                $_SESSION['num_client'] = $num_client;
                $_SESSION['cantidad']   = $this -> decimales($cant);
                $this -> redirect('instrucciones');
            }
        }

        function trasferencia(){
            if ($this -> existPOST(['accion', 'clabe', 'cant', 'motivo'])) {

                if ($this -> validateData(['accion','cant','clabe'])) {
                    $this -> redirect('ver/tranferencias', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }

                if (!empty($_POST['motivo'])) {
                    if ($this -> validateData(['motivo'])) {
                        $this -> redirect('ver/tranferencias', ['error' => Errors::ERROR_DATA]);
                        return;
                    }
                }

                $cant = $this -> getPost('cant');

                if ($this -> cliente -> getSaldo() < $cant) {
                    $this->redirect('ver/tranferencias', ['error' => Errors::ERROR_MONEY_CANT]);
                    return;
                }

                if (!$this -> model -> existClabe($_POST['clabe'])) {
                    $this->redirect('ver/tranferencias', ['error' => Errors::ERROR_NOEXIST_CLIENT]);
                    return;
                }

                if ($this -> model -> transferencia($cant, $_POST['clabe'], $_POST['accion'], $this -> cliente -> getNum_client())) {
                    $this -> model -> updateSaldo($cant, $this -> cliente -> getSaldo(), $this -> cliente -> getNum_client());
                    
                    $this -> redirect('ver', ['success' => Success::SUCCESS_ACTION]);
                    return;
                }

                $this -> redirect('ver/tranferencias', ['error' => Errors::ERROR_ACTION]);
                return;
            }
        }

        function generateQR($num_client, $cant){
            $this -> filename = $this -> rute . 'retiro.png';
        	$this -> contenido = '["' . $num_client .'",'. $cant .']';
            QRcode::png($this -> contenido, $this -> filename, $this -> level, $this -> tamp, $this -> frameSize);
        }

        function decimales($value){return number_format($value, 2, '.', '');}

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
        
        function generarEstadoDeCuenta(){
            $this -> redirect('estadodecuenta');
        }

        public function pagos(){
            $data = $this -> loan -> calPayment($_POST['num_prestamo']);

            $this -> payment($data,$_POST['num_prestamo']);
        }

        function payment($data, $num_prestamo){
            $this -> view -> render("templates/pagos",[
                "payment"      => $data,
                "num_prestamo" => $num_prestamo
            ]);
        }

        public function pagar(){
            if ($this -> existPOST(['pago', 'accion', 'num_prestamo'])) {
                $data = $this -> loan -> calPayment($_POST['num_prestamo']);

                if (!$data['pago'] == $_POST['pago'] || !$data['total'] == $_POST['pago']) {
                   $this -> redirect('ver/pagos', ['error' => Errors::ERROR_LOAN_CANT]);
                }

                if($data['pago'] == $_POST['pago'] && $this -> cliente -> getSaldo() >= $_POST['pago']){
                    if ($this -> loan -> pagarPrestamo($_POST['num_prestamo'], $_POST['accion'], $data['interes'], $_POST['pago'], $this -> cliente -> getSaldo())) {
                        $this -> redirect('ver', ['success' => Success::SUCCESS_LOAN_PAYMENT]);
                        return;
                    }
                } 

                if ($data['total'] == $_POST['pago'] && $this -> cliente -> getSaldo() >= $_POST['pago']) {
                    if ($this -> loan -> pagarTotalPrestamo($_POST['num_prestamo'], $_POST['accion'], $data['interes'], $_POST['pago'], $this -> cliente -> getSaldo())) {
                        $this -> redirect('ver', ['success' => Success::SUCCESS_LOAN_PAGADO]);
                        return;
                    }
                }

                $this -> redirect('ver/pagos', ['error' => Errors::ERROR_MONEY_CANT]);
            }

            $this -> redirect('ver/pagos', ['error' => Errors::ERROR_DATA_EMPTY]);
        }

        function cerrar(){$this -> redirect("ver");}
    }

?>