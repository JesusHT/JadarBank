<?php
    class MovimientosModel extends Model {
        private $movimientos;
        private $cargo;
        private $fecha;
        private $descripcion;
        private $monto;
        private $saldo;
        private $num_client ;

        function __construct(){
            parent::__construct();

            $this -> fecha = date('y-m-d');
            $this -> movimientos = ['retiro', 'trasferencia', 'presatamo', 'pago', 'otro'];
        }

        function generarMovimiento(){
            try {
                $query = $this -> prepare('INSERT INTO movimientos (num_client, cargo, descripcion, cant, fecha, saldo) VALUES (:num_client, :cargo, :descripcion, :cant, :fecha, :saldo)');
                $query -> execute([
                    'num_client'  => $this -> num_client,
                    'cargo'       => $this -> cargo,
                    'descripcion' => $this -> descripcion,
                    'cant'        => $this -> monto,
                    'fecha'       => $this -> fecha,
                    'saldo'       => $this -> saldo
                ]);

                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function querySaldo(){
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

        function setNum_client ($num_client ){ $this -> num_client  = $num_client                             ;}
        function setCargo      ($accion     ){ $this -> cargo       = $this -> movimientos[$accion]           ;}
        function setDescripcion($descripcion){ $this -> descripcion = $descripcion                            ;}
        function setMonto      ($monto      ){ $this -> monto       = $monto                                  ;}
        function setSaldo      (            ){ $this -> saldo       = $this -> querySaldo($this -> num_client);}
    }

?>