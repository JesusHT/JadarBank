<?php

    class UpdateInfoModel extends Model {

        private $customer;

        function __construct(){
            parent::__construct();
            $this -> customer = new UserModel();
            $this -> customer -> getUsers($_SESSION['user']);
        }
        
        function newPassword($pass, $newPass){
            if (password_verify($pass,$this -> customer -> getPass())) {
                try {
                    $query = $this -> prepare('UPDATE cliente SET pass = :pass WHERE num_client = :num_client');
                    $query -> execute([
                        'pass' => password_hash($newPass, PASSWORD_BCRYPT),
                        'num_client' => $this -> customer -> getNum_client()
                    ]);

                    return true;
                } catch(PDOException $e){
                    echo $e;
                    return false;
                }
            }

            return false;
        }

        function updateConfiguration($validacion, $cobro){
            try {
                $query = $this -> prepare('UPDATE configuracion SET validacion = :validacion, cobro = :cobro WHERE num_client = :num_client');
                $query -> execute([
                    'num_client' => $this -> customer -> getNum_client(),
                    'validacion' => $validacion,
                    'cobro'      => $cobro
                ]);

                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function updateNotifications($movimientos, $sesion, $promociones){
            try {
                $query = $this -> prepare('UPDATE configuracion SET movimientos = :movimientos, sesion = :sesion, promociones = :promociones WHERE num_client = :num_client');
                $query -> execute([
                    'num_client'  => $this -> customer -> getNum_client(),
                    'movimientos' => $movimientos,
                    'sesion'      => $sesion,
                    'promociones' => $promociones
                ]);

                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
    
    }

?>