<?php   
    class MainModel extends Model {

        private $customer;
        private $account;

        function __construct(){
            parent::__construct();

            $this -> customer = new UserModel();
            $this -> customer -> getUsers($_SESSION['user']);
            $this -> account  = new CuentasModel();
            $this -> account -> queryAccount();
        }

        function updateSaldo($cant){
            $nuevoSaldo = $this -> account -> getSaldo() - $cant;

            try {
                $query = $this -> prepare('UPDATE cuenta SET saldo = :saldo WHERE num_client = :num_client');
                $query -> execute(['saldo' => $nuevoSaldo, 'num_client' => $this -> customer -> getNum_client()]);

                return true;

            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function transferencia($cant, $clabe){
            try {
                $query = $this -> prepare('UPDATE cuenta SET saldo = :saldo WHERE num_cuenta = :num_cuenta');
                $query -> execute([
                    'saldo' => $cant, 
                    'num_cuenta' => $clabe
                ]);

                return true;

            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function generateLoan($cantidad, $plazo, $accion){
            $load = new PrestamosModel();
            $load -> setNum_client($this -> customer -> getNum_client());
            $load -> setMonto($cantidad);     
            $load -> setInteres(0.075);     
            $load -> setPlazo($plazo);     
            $load -> setStatus('pendiente');     
            $load -> setNum_prestamo();

            if ($load -> generarPrestamo() && $this -> updateCredito($cantidad)){
                if ($this -> generarMovimiento($accion, $cantidad)) {
                    return true;
                }
            }

            return false;
        }

        function updateCredito($cant){
            $creditoUsado = $this -> account -> getUsado() + $cant;

            try {
                $query = $this -> prepare('UPDATE cuenta SET usado = :usado WHERE num_client = :num_client');
                $query -> execute([
                    'usado' => $creditoUsado, 
                    'num_client' => $this -> customer -> getNum_client()
                ]);

                return true;

            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function cantSuficiente($cant){
            if ($this -> account -> getSaldo() >= $cant) {
                return false;
            }

            return true;
        }

        function validateLoad($cant){
            $credito = $this -> account -> getCredito() - $this -> account -> getUsado();

            if ($cant <= $credito) {
                return false;
            }

            return true;
        }

        function setContact($alias, $clabeInterbancaria){
            try {
                $query = $this -> prepare('INSERT INTO guardados (num_client, clabeInterbancaria, alias) VALUES (:num_client, :clabeInterbancaria, :alias)');
                $query -> execute([
                    'num_client'          => $this -> customer -> getNum_client(),
                    'clabeInterbancaria'  => $clabeInterbancaria,
                    'alias'               => $alias
                ]);

                return true;

            } catch (PDOException $e){
                echo $e;
                return false;
            }
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

        function generarMovimiento($accion, $cantidad){
            $movimientos = new MovimientosModel();

            $movimientos -> setNum_client($this -> customer -> getNum_client());
            $movimientos -> setCargo($accion);      
            $movimientos -> setDescripcion("Prestamo personal");
            $movimientos -> setMonto($cantidad);      
            $movimientos -> setSaldo(); 

            if ($movimientos -> generarMovimiento()) {
                return true;
            }

            return false;
        }
    }

?>