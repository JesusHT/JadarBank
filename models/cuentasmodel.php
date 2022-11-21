<?php

    class CuentasModel extends Model {
        
        private $customer;

        private $num_client;
        private $num_cuenta;
        private $saldo;
        private $credito;
        private $usado;

        function __construct(){
            parent::__construct();

            $this -> customer = new UserModel();
            $this -> customer -> getUsers($_SESSION['user']);

        }
        
        function queryAccount(){
            try {
                $query = $this -> prepare('SELECT * FROM cuenta WHERE num_client = :num_client');
                $query -> execute(['num_client'=> $this -> customer -> getNum_client()]);

                if($query->rowCount() == 1){
                    $account = $query -> fetch(PDO::FETCH_ASSOC); 

                    $this -> from($account);
                    
                    return $account;
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function queryConfiguration(){
            try {
                $query = $this -> prepare('SELECT * FROM configuracion WHERE num_client = :num_client');
                $query -> execute(['num_client' => $this -> customer -> getNum_client()]);

                if($query->rowCount() == 1){
                    $configuration = $query -> fetch(PDO::FETCH_ASSOC); 

                    return $configuration;
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        
        function queryContacts(){
            try {
                $query = $this -> prepare('SELECT * FROM guardados WHERE num_client = :num_client');
                $query -> execute(['num_client' => $this -> customer -> getNum_client()]);

                $Contacts = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($Contacts) > 0) {
                    $i = 2;
                    $Data = '';
                    foreach ($Contacts as $contact) {
                        $Data .= '
                                <input id="radio'. $i .'" type="radio" name="opciones" value="'. $contact -> clabeInterbancaria .'">
                                <label for="radio'. $i .'">'. $contact -> alias .'</label> ';
                        $i++;
                    }

                    return $Data;
                }
            
                return NULL;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function from($array){
            $this -> num_client = $array['num_client']; 
            $this -> num_cuenta = $array['num_cuenta'];
            $this -> saldo      = $array['saldo'];
            $this -> credito    = $array['credito'];
            $this -> usado      = $array['usado'];
        }

        function getNum_client (){return $this -> num_client; }
        function getNum_cuenta (){return $this -> num_cuenta; }
        function getSaldo      (){return $this -> saldo     ; }
        function getCredito    (){return $this -> credito   ; }
        function getUsado      (){return $this -> usado     ; }
    }

?>