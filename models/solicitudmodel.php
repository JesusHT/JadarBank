<?php 

    class SolicitudModel extends Model {

        private $status;

        function __construct(){
            parent::__construct();
            
            $this -> status = 'activo';    
        }

        function aceptado($num_client, $id){
            if ($this -> existRequest($id)) {
                try {
                    $query = $this -> prepare('UPDATE cliente SET status = :status, num_client = :num_client WHERE id = :id');
                    $query -> execute([
                        'id'          => $id,
                        'num_client'  => $num_client,
                        'status'      => $this -> status
                    ]);

                    return true;

                } catch (PDOException $e) {
                    echo $e;
                    return NULL;
                }
            } 

            return NULL;
        }

        function rechazado($id){
            if ($this -> existRequest($id)) {
                try {
                    $query = $this -> prepare('DELETE FROM cliente WHERE id = :id');
                    $query -> execute(['id' => $id]);

                    return true;

                } catch (PDOException $e) {
                    echo $e;
                    return NULL;
                }
            } 

            return NULL;
        }

        function existRequest($id){
            try{
                $query = $this -> prepare('SELECT status FROM cliente WHERE id = :id');
                $query -> execute(['id' => $id]);
                $requests = $query -> fetch(PDO::FETCH_ASSOC);

                if ($query->rowCount() == 1) {
                    if ($requests['status'] === 'pendiente') {
                        return true;
                    }
                    
                    return false;
                }

                return false;

            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }
        
    }
    

?>