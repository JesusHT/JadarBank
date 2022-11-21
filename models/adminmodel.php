<?php

    class AdminModel extends Model {

        function __construct(){
            parent::__construct();
        }

        function validateStatusPrestamos($num_client){
            try {
                $query = $this ->  prepare("SELECT status FROM prestamos WHERE num_client = :num_client AND status = 'pendiente'");
                $query -> execute(['num_client' => $num_client]); 
                
                if ($query->rowCount() == 1) {
                    return true;
                }

                return false;

            } catch (PDOException $e) {
                echo $e;
                return true;
            }
        }

        function validateAccount($num_client){
            try {
                $query = $this ->  prepare("SELECT saldo FROM prestamos WHERE num_client = :num_client AND saldo = '0'");
                $query -> execute(['num_client' => $num_client]); 
                
                if ($query->rowCount() == 1) {
                    return true;
                }

                return false;
            } catch (PDOException $e) {
                echo $e;
                return true;
            }
        }
    }

?>