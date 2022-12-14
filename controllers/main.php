<?php
	require_once './Includes/phpqrcode/qrlib.php';
    require_once './models/prestamosmodel.php';

    class Main extends Controller {
        private $movimientos;
        private $loan;

        private $rute;
        private $tamp;
        private $level;
        private $frameSize;
        private $contenido;
        private $filename; 

        function __construct(){
            parent::__construct();
            
            $this -> redirectRole();

            $account = $this -> account();
            $this -> loan = new LoanModel();

            $this -> view -> render('main/index',[
                'account'      => $account,
                'aviso'        => $this -> getAviso(),
                'movimientos'  => $this -> getMovimientos()
            ]);
            
            $this -> rute        = constant('URL-IMG');
            $this -> tamp        = 15;
            $this -> level       = 'H';
            $this -> frameSize   = 1;
            $this -> contenido   = '';
            $this -> movimientos = ["retiros", "tranferencias", "prestamos"];
        }

        function account(){
            $query = new CuentasModel();

            return $query -> queryAccount();
        }

        function getContact(){
            $query = new CuentasModel();

            return $query -> queryContacts();
        }

        function getAviso(){
            $client = new UserModel();
            $client -> getUsers($_SESSION['user']);

            return $this -> loan -> aviso($client -> getNum_client());
        }

        function getMovimientos(){
            $client = new UserModel();
            $client -> getUsers($_SESSION['user']);
            $movimientos = new MovimientosModel();

            return $movimientos -> queryMovimientos($client -> getNum_client());
        }

        function movimientos(){
            if ($this -> existGET(['v'])) {
                for ($i=0; $i < 3; $i++) {
                    if ($_GET['v'] === $this -> movimientos[$i]){
                        $this -> {$_GET['v']}();
                        return;
                    }
                }
                $this -> cerrar();
            }
        }

        function retiro(){
            if ($this -> existPOST(['num_client', 'cant', 'accion'])) {
                if ($this -> validateData(['num_client','cant'])) {
                    $this->redirect('main/retiros', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }
                
                $cant       = $this -> getPost('cant');
                $num_client = $this -> getPost('num_client');

                if ($this -> model -> cantSuficiente($cant)) {
                    $this->redirect('main/retiros', ['error' => Errors::ERROR_RETIRO]);
                    return;
                }

                $client = new UserModel();
                $client -> getUsers($_SESSION['user']);

                $this -> model -> updateSaldo($cant);
                $this -> model -> generarMovimiento($_POST['accion'], $cant, "" , $client -> getNum_client());

                $this -> generateQR($num_client, $cant);

                $_SESSION['ruta']       = 'main';
                $_SESSION['accion']     = 'Retiro';
                $_SESSION['num_client'] = $num_client;
                $_SESSION['cantidad']   = $this -> decimales($cant);
                $this -> redirect('instrucciones');

            }
        }

        function generateLoan(){
            if ($this -> existPOST(['cantidad', 'plazo', 'accion'])) {

                if ($_POST['plazo'] < 0 || $_POST['plazo'] > 12) {
                    $this->redirect('main/prestamos', ['error' => Errors::ERROR_DATA]);
                    return;
                }

                if ($this -> model -> validateLoad($_POST['cantidad'])) {
                    $this -> redirect('main/prestamos', ['error' => Errors::ERROR_LOAN]);
                    return;
                }

                if ($this -> model -> generateLoan($_POST['cantidad'], $_POST['plazo'], $_POST['accion'])) {
                    $this -> redirect('main', ['success'=>Success::SUCCESS_LOAN_APPROVED]);
                    return;
                }
            }
        }

        function trasferencia(){
            if ($this -> existPOST(['accion', 'clabeInterbancaria', 'alias', 'cantidad', 'motivo', 'opciones'])) {

                if ($this -> validateData(['accion','cantidad','opciones'])) {
                    $this -> redirect('main/tranferencias', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }

                if (!empty($_POST['motivo'])) {
                    if ($this -> validateData(['motivo'])) {
                        $this -> redirect('main/tranferencias', ['error' => Errors::ERROR_DATA]);
                        return;
                    }
                }

                $cant = $this -> getPost('cantidad');

                if ($this -> model -> cantSuficiente($cant)) {
                    $this->redirect('main/tranferencias', ['error' => Errors::ERROR_RETIRO]);
                    return;
                }

                if (!$this -> validateData(['alias','clabeInterbancaria'])) {
                    if (!$this -> model -> existClabe($_POST['clabeInterbancaria'])) {
                        $this->redirect('main/tranferencias', ['error' => Errors::ERROR_NOEXIST_CLIENT]);
                        return;
                    }

                    $this -> model -> setContact($_POST['alias'], $_POST['clabeInterbancaria']);
                }

                if ($this -> model -> transferencia($cant, $_POST['opciones'], $_POST['accion'])) {
                    $this -> model -> updateSaldo($cant);
                    
                    $this -> redirect('main', ['success' => Success::SUCCESS_ACTION]);
                    return;
                }

                $this -> redirect('main/tranferencias', ['error' => Errors::ERROR_ACTION]);
                return;
            }
        }

        function generateQR($num_client, $cant){
            $this -> filename = $this -> rute . 'retiro.png';
        	$this -> contenido = '["' . $num_client .'",'. $cant .']';
            QRcode::png($this -> contenido, $this -> filename, $this -> level, $this -> tamp, $this -> frameSize);
        }

        function retiros(){
            $account = $this -> account();

            $this -> view -> render("main/retiros",[
                "cuenta" => $account
            ]);
        }

        function tranferencias(){
            $account  = $this -> account();
            $contacts = $this -> getContact();

            $this -> view -> render("main/tranferencias",[
                "cuenta"    => $account,
                "contactos" => $contacts
            ]);
        }

        function prestamos(){
            $account = $this -> account();

            $this -> view -> render("main/prestamo",[
                "cuenta" => $account
            ]);
        }

        function generarEstadoDeCuenta(){
            $this -> redirect('estadodecuenta');
        }

        function decimales($value){return number_format($value, 2, '.', '');}

        function cerrar(){$this -> redirect("main");}
    }

?>