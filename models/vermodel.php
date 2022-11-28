<?php 

    class VerModel extends Model {
        function __construct(){
            parent::__construct();
        }

        function generarMovimiento($accion, $cantidad, $descripcion, $num_client){
            $movimientos = new MovimientosModel();
            
            $movimientos -> setNum_client($num_client);
            $movimientos -> setCargo($accion);      
            $movimientos -> setDescripcion($descripcion);
            $movimientos -> setMonto($cantidad);      
            $movimientos -> setSaldo(); 
            
            if ($movimientos -> generarMovimiento()) {
                return true;
            }

            return false;
        }

        function existClabe($clabe){
            try{
                $query = $this -> prepare('SELECT num_cuenta FROM cuenta WHERE num_cuenta = :num_cuenta');
                $query->execute(['num_cuenta' => $clabe]);
                
                if($query->rowCount() > 0){
                    return true;
                }
                
                return false;
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        function transferencia($cant, $clabe, $accion){
            $customer = new CustomersModel();
            $customer -> queryAccountForClabe($clabe);
            $nuevoSaldo = $cant + $customer -> getSaldo();

            try {
                $query = $this -> prepare('UPDATE cuenta SET saldo = :saldo WHERE num_cuenta = :num_cuenta');
                $query -> execute([
                    'saldo' => $nuevoSaldo, 
                    'num_cuenta' => $clabe
                ]);

                if ($this -> generarMovimiento($accion, $cant, "Deposito de efectivo." , $customer -> getNum_client())) {
                    return true;
                }
            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }
    }


?>