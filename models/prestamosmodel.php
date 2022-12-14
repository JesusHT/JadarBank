<?php

    class PrestamosModel extends Model {
        private $num_client;
        private $num_prestamo;
        private $monto;
        private $interes;
        private $plazo;
        private $fe_asignado;
        private $status;
        
        function __construct(){
            parent::__construct();

            $this -> num_client   = '';
            $this -> num_prestamo = '';
            $this -> monto        = '';
            $this -> interes      = '';
            $this -> plazo        = '';
            $this -> fe_asignado  = date('y-m-d');
            $this -> status       = '';   
        }

        public function generarPrestamo(){
            try {
                $query = $this -> prepare('INSERT INTO prestamos (num_client, num_prestamo, monto, interes, plazo, fe_asignado, status) VALUE (:num_client, :num_prestamo, :monto, :interes, :plazo, :fe_asignado, :status)');
                $query -> execute([
                    'num_client'   => $this -> num_client,
                    'num_prestamo' => $this -> num_prestamo,
                    'monto'        => $this -> monto,
                    'interes'      => $this -> interes,
                    'plazo'        => $this -> plazo,
                    'fe_asignado'  => $this -> fe_asignado,
                    'status'       => $this -> status
                ]);

                if ($this -> sendMoney()) {
                    return true;
                }

                return false;
                
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        
        public function clientExist($num_client){
            try {
                $query = $this -> prepare('SELECT num_client FROM cliente WHERE num_client = :num_client');
                $query -> execute(['num_client' => $num_client]);
                
                if($query->rowCount() > 0){
                    return false;
                }
                
                return true;
            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        public function sendMoney(){
            try {
                $query = $this -> prepare('UPDATE cuenta SET saldo = :saldo WHERE num_client = :num_client');
                $query -> execute([
                    'num_client'   => $this -> num_client,
                    'saldo'        => $this -> monto + $this -> getSaldo()
                ]);
                
                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        public function getSaldo(){
            try {
                $query = $this -> prepare('SELECT saldo FROM cuenta WHERE num_client = :num_client');
                $query -> execute(['num_client'=> $this -> num_client]);

                if($query->rowCount() == 1){
                    $account = $query -> fetch(PDO::FETCH_ASSOC); 

                    return $account['saldo'];
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        
        public function setNum_prestamo(){ 
            try {
                $query = $this -> prepare('SELECT id FROM prestamos ORDER by id DESC LIMIT 1');
                $query -> execute(); 
                $cant = $query -> fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                echo $e;
            }

            $this -> num_prestamo = $this -> num_client . '-'. date('ynd') . $cant['id'] + 1;
        }
        public function setNum_client ($num_client){ $this -> num_client   = $num_client   ;}
        public function setMonto      ($monto     ){ $this -> monto        = $monto        ;}
        public function setInteres    ($interes   ){ $this -> interes      = $interes      ;}
        public function setPlazo      ($plazo     ){ $this -> plazo        = $plazo        ;}
        public function setStatus     ($status    ){ $this -> status       = $status       ;}
    }

?>