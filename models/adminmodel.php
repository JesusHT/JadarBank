<?php

    class AdminModel extends Model {
        private $status;

        function __construct(){
            parent::__construct();
            $this -> status = 'pendiente';
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
    }

?>