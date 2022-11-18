<?php
	require_once './Includes/phpqrcode/qrlib.php';

    class Main extends Controller {
        
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

            $this -> view -> render('main/index',[
                'account' => $account
            ]);
            
            $this -> rute       = constant('URL-IMG');
            $this -> tamp       = 15;
            $this -> level      = 'H';
            $this -> frameSize  = 1;
            $this -> contenido  = '';
        }

        function account(){
            $client = new UserModel();
            $client -> getUsers($_SESSION['user']);
            $num_client = $client -> getNum_client();

            $query = new CuentasModel();

            return $query -> queryAccount($num_client);
        }

        function retiro(){
            if ($this -> existPOST(['num_client', 'cant'])) {
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

                $this -> model -> updateSaldo($cant);
                $this -> generateQR($num_client, $cant);

                $_SESSION['accion'] = 'Retiro';
                $this -> redirect('instrucciones');

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
            $account = $this -> account();

            $this -> view -> render("main/tranferencias",[
                "cuenta" => $account
            ]);
        }

        function cerrar(){
            $this -> redirect("main");
        }
    }

?>