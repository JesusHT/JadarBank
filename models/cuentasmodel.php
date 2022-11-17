<?php

    class CuentasModel extends Model {
        private $num_client;
        private $num_cuenta;
        private $saldo;
        private $credito;
        private $usado;

        function __construct(){
            parent::__construct();

            $this -> num_client = '';
            $this -> num_cuenta = '';
            $this -> saldo      = '';
            $this -> credito    = '';
            $this -> usado      = '';
        }
        
        function queryAccount($num_client){
            try {
                $query = $this -> prepare('SELECT * FROM cuenta WHERE num_client = :num_client');
                $query -> execute(['num_client'=> $num_client]);

                if($query->rowCount() == 1){
                    $account = $query -> fetch(PDO::FETCH_ASSOC); 

                    return $account;
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
    }

?>