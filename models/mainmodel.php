<?php

    class MainModel extends Model {

        private $num_client;
        private $num_cuenta;
        private $saldo;
        private $credito;
        private $usado;

        function __construct(){
            parent::__construct();

            $account = new CuentasModel();
            $client = new UserModel();
            $client -> getUsers($_SESSION['user']);

            $this -> from($account -> queryAccount($client -> getNum_client()));
        }

        function from($array){
            $this -> num_client = $array['num_client']; 
            $this -> num_cuenta = $array['num_cuenta'];
            $this -> saldo      = $array['saldo'];
            $this -> credito    = $array['credito'];
            $this -> usado      = $array['usado'];
        }

        function cantSuficiente($cant){
            if ($this -> saldo >= $cant) {
                return false;
            }

            return true;
        }
    }

?>