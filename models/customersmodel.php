<?php 
    class CustomersModel extends Model {
        
        # Tabla clientes

        private $num_client ;
        private $id         ;
        private $name       ;
        private $fena       ;
        private $curp       ;
        private $img_client ;
        private $domicilio  ;
        private $codPostal  ;
        private $estado     ;
        private $ciudad     ;
        private $pais       ;
        private $tel        ;
        private $email      ;
        private $pass       ;
        private $role       ;
        private $status     ;

        # Tabla cuentas

        private $num_cuenta ;
        private $saldo      ;
        private $credito    ;
        private $usado      ;
        
        function __construct(){
            parent::__construct();
        }

        function queryCustomer($id){
            try {
                $query = $this -> prepare('SELECT * FROM cliente WHERE id = :id');
                $query -> execute(['id' => $id]);
                
                if($query->rowCount() == 1){
                    $item = $query -> fetch(PDO::FETCH_ASSOC); 
                    $this -> fromCustomer($item);

                    return true;
                }

                return false;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function queryAccountForNumClient($num_client){
            try {
                $query = $this -> prepare('SELECT * FROM cuenta WHERE num_client = :num_client');
                $query -> execute(['num_client' => $num_client]);
                
                if($query->rowCount() == 1){
                    $item = $query -> fetch(PDO::FETCH_ASSOC); 
                    $this -> fromAccount($item);

                    return true;
                }

                return false;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function queryAccountForClabe($num_cuenta){
            try {
                $query = $this -> prepare('SELECT * FROM cuenta WHERE num_cuenta = :num_cuenta');
                $query -> execute(['num_cuenta' => $num_cuenta]);
                
                if($query->rowCount() == 1){
                    $item = $query -> fetch(PDO::FETCH_ASSOC); 
                    $this -> fromAccount($item);

                    return true;
                }

                return false;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function fromAccount($array){
            $this -> num_client = $array['num_client'];            
            $this -> num_cuenta = $array['num_cuenta'];
            $this -> saldo      = $array['saldo'];
            $this -> credito    = $array['credito'];
            $this -> usado      = $array['usado'];     
        }

        function fromCustomer($array){
            $this -> id         = $array['id'];            
            $this -> name       = $array['name'];            
            $this -> fena       = $array['fena'];            
            $this -> curp       = $array['curp'];            
            $this -> img_client = $array['img_client'];            
            $this -> domicilio  = $array['domicilio'];            
            $this -> codPostal  = $array['codPostal'];            
            $this -> estado     = $array['estado'];            
            $this -> ciudad     = $array['ciudad'];            
            $this -> pais       = $array['pais'];            
            $this -> tel        = $array['tel'];            
            $this -> email      = $array['email'];            
            $this -> pass       = $array['pass'];            
            $this -> role       = $array['role'];            
            $this -> status     = $array['status'];            
            $this -> num_client = $array['num_client'];            
        }

        function getNum_cuenta  (){return $this -> num_cuenta ;}
        function getSaldo       (){return $this -> saldo      ;}
        function getCredito     (){return $this -> credito    ;}
        function getUsado       (){return $this -> usado      ;}

        function getId          (){return $this -> id         ;}
        function getName        (){return $this -> name       ;}
        function getFena        (){return $this -> fena       ;}
        function getCurp        (){return $this -> curp       ;}
        function getImg_client  (){return $this -> img_client ;}
        function getDomicilio   (){return $this -> domicilio  ;}
        function getCodPostal   (){return $this -> codPostal  ;}
        function getEstado      (){return $this -> estado     ;}
        function getCiudad      (){return $this -> ciudad     ;}
        function getPais        (){return $this -> pais       ;}
        function getTel         (){return $this -> tel        ;}
        function getEmail       (){return $this -> email      ;}
        function getPass        (){return $this -> pass       ;}
        function getNum_client  (){return $this -> num_client ;}
        function getRole        (){return $this -> role       ;}
        function getStatus      (){return $this -> status     ;} 
    }
?>