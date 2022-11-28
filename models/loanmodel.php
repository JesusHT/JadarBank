<?php 

    class LoanModel extends Model {
        # Variable de tabla prestamo
        private $num_client       ;
        private $num_prestamo     ;
        private $monto            ;
        private $interes          ;
        private $plazo            ;
        private $fe_asignado      ;
        private $status           ;

        private $cuota            ;
        private $calPagos         ;
        private $interesesPagados ;
        private $fechasPagadas    ;

        private $fechas           ;
        private $style            ;
        private $interesDia       ;
        private $aviso            = array();
        private $dataPayment      = array();
        
        function __contruct(){
            parent::__construct(); 
            $this -> fechasPagadas = 0;
        }

        function existLoan($key){
            try {
                $query = $this -> prepare('SELECT * FROM prestamos WHERE num_prestamo = :num_prestamo');
                $query -> execute(['num_prestamo' => $key]);
                
                if($query->rowCount() > 0){
                    $loan = $query -> fetch(PDO::FETCH_ASSOC); 
                    $this -> from($loan);

                    return true;
                }
                
                return false;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function pagarPrestamo($num_prestamo, $accion, $interes, $cantidad, $saldo){
            try {
                $query = $this -> prepare('INSERT INTO pagos (num_prestamo, fecha, cant, interes) VALUES (:num_prestamo, :fecha, :cant, :interes)');
                $query -> execute([
                    "num_prestamo" => $num_prestamo,
                    "fecha" => date("Y-m-d"),
                    "cant" => $cantidad,
                    "interes" => $interes
                ]);

                $this -> generarMovimiento($accion, $cantidad, "Pago de prestamo " . $num_prestamo . '.');
                $this -> updateSaldo($cantidad, $saldo);

                return true;

            } catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        function pagarTotalPrestamo($num_prestamo, $accion, $interes, $cantidad, $saldo){
            try {
                $query = $this -> prepare("UPDATE prestamos SET status = 'pagado' WHERE num_prestamo = :num_prestamo");
                $query -> execute(['num_prestamo' => $num_prestamo]);

                $this -> generarMovimiento($accion, $cantidad, "Total del prestamo " . $num_prestamo . ' liquidado.');
                $this -> updateSaldo($cantidad, $saldo);

                return true;

            } catch(PDOException $e){
                echo $e;
                return false;              
            }
        }

        function calDatePayments(){
            $data  = '';
            $this -> cuotaFija();
            $this -> calPayments();

            for ($i=0; $i < count($this -> dataPayment); $i++) { 
                $data .= 
                    '<tr>
                        <td class="text-center">' . $i + 1                                         . '</td>
                        <td>'.        $this -> dataPayment[$i]                                     . '</td>
                        <td class="'. $this -> style[$i]                                           . ' text-center status"><i class="fa-solid fa-circle"></i></td>
                        <td>$'.       $this -> decimales($this -> cuota)                           . '</td>
                        <td>$'.       $this -> decimales($this -> interesDia[$i])                  . '</td>
                        <td>$'.       $this -> decimales($this -> cuota + $this -> interesDia[$i]) . '</td>
                    </tr>';
            }

            return $data;
        }

        function aviso($num_client){
            try {
                $query = $this -> prepare("SELECT * FROM prestamos WHERE num_client = :num_client AND status = 'pendiente'");
                $query -> execute(['num_client' => $num_client]);

                $results = $query -> fetchAll(PDO::FETCH_OBJ);

                foreach ($results as $result) {
                    $this -> existLoan($result -> num_prestamo);
                    $this -> calPaymentsAviso($result -> num_prestamo);

                }

                return $this -> aviso;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function calPayments(){
            $this -> dateCal();
            $this -> countPayments();

            for ($i=0; $i < count($this -> dataPayment); $i++) { 
                if ($i <= $this -> fechasPagadas) {
                    
                    $this -> style[$i]      = 'pagado';
                    $this -> interesDia[$i] = $this -> interesesPagados[$i];
                } else {
                    if($this -> differenceDate($this -> dataPayment[$i])){
                        array_push($this -> aviso, "<p class='bg-error'>!Tiene un prestamo vencido pagalo pronto! (". $this -> num_prestamo  .")</p>");

                        $this -> fe_asignado = $this -> dataPayment[$i];

                        $año = $this -> separateDate(2);
                        $mes = $this -> separateDate(5);
                        $dia = $this -> separateDate(8);

                        $this -> style[$i] = 'atrasado';
                        $this -> interesDia[$i] = $this -> calInteres($this -> ceros($dia), $this -> ceros($mes), $año);
                    } else if ($this -> differenceDate($this -> dataPayment[$i]) === NULL){
                        array_push($this -> aviso, '<p class="bg-warning">!Tiene un prestamo que esta próximo a vencerse paga lo más antes posible! ('. $this -> num_prestamo  .')</p>');
                        $this -> style[$i] = 'pendiente';
                        $this -> interesDia[$i] = 0; 
                    } else {
                        $this -> style[$i] = '';
                        $this -> interesDia[$i] = 0;    
                    } 
                }
            }
        }

        function calPaymentsAviso($num_prestamo){
            try {
                $query = $this -> prepare("SELECT * FROM pagos WHERE num_prestamo = :num_prestamo");
                $query -> execute(['num_prestamo' => $num_prestamo]);
                $payments = $query -> fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e;
                return false;
            }

            $año = $this -> separateDate(2);
            $mes = $this -> separateDate(5);
            $dia = $this -> separateDate(8);

            for ($i=1; $i <= $this -> plazo; $i++) { 

                if ($mes < 12) { 
                    $mes += 1;
                } else {
                    $mes =  1;
                    $año += 1;
                }

                $fecha = $this -> ceros($dia). '-' . $this -> ceros($mes) . '-' . $año;

                if (count($payments) > 0 && $i <= count($payments)) {
                    foreach ($payments as $payment) {
                        if ($this -> dateValidate($fecha, $this -> reacomodarFecha($payment -> fecha))) {
                        }
                    }
                } else if($this -> differenceDate($fecha)){
                    array_push($this -> aviso, "<p class='bg-error'>!Tiene un prestamo vencido pagalo pronto! (". $this -> num_prestamo  .")</p>");

                } else if($this -> differenceDate($fecha) === NULL){
                    array_push($this -> aviso, '<p class="bg-warning">!Tiene un prestamo que esta próximo a vencerse paga lo más antes posible! ('. $this -> num_prestamo  .')</p>');
                }
             }
        }

        function calPayment($num_prestamo){
            $this -> existLoan($num_prestamo);
            $this -> dateCal();
            $this -> countPayments();
            $this -> cuotaFija();

            $total   = $this -> cuota * ($this -> plazo - $this -> fechasPagadas);
            $interes = 0;

            if ($this -> differenceDate($this -> dataPayment[$this -> fechasPagadas+1])) {
                $this -> fe_asignado = $this -> dataPayment[$this -> fechasPagadas+1];

                $año = $this -> separateDate(2);
                $mes = $this -> separateDate(5);
                $dia = $this -> separateDate(8);

                $interes = $this -> calInteres($dia, $mes, $año);
            }

            $data = array("pago"=> $this -> decimales($this -> cuota + $interes),  "interes"=> $this -> decimales($interes), "total"=>$this -> decimales($total + $interes), "plazo"=> $this -> fechasPagadas + 1, "plazos" => $this -> plazo, 'totalSin' => $this -> decimales($total));

            return $data;
        }

        function countPayments(){
            try {
                $query = $this -> prepare('SELECT * FROM pagos WHERE num_prestamo = :num_prestamo');
                $query -> execute(['num_prestamo' => $this -> num_prestamo]);
                $payments = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($payments) > 0 ) {
                    $count = 0;

                    foreach ($payments as $payment) {
                        $this -> fechasPagadas = $count;
                        $this -> interesesPagados[$count] = $payment -> interes;
                        $count += 1;
                    }

                    return;
                } 

                $this -> fechasPagadas = -1;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function dateCal(){
            $año = $this -> separateDate(2);
            $mes = $this -> separateDate(5);
            $dia = $this -> separateDate(8);

            for ($i=1; $i <= $this -> plazo; $i++) { 
                if ($mes < 12) { 
                    $mes += 1;
                } else {
                    $mes =  1; 
                    $año += 1;
                }

                array_push($this -> dataPayment, $año . '-' . $this -> ceros($mes) . '-' . $this -> ceros($dia));
            }
        }
        
        function calInteres($dia, $mes, $año){
            $this -> calInteresTotal();
            $this -> calDiasDeAtraso($dia, $mes, $año);

            $interes =  $this -> interesTotal / $this -> plazo;
            
            return $this -> DiasAtraso * $interes;
        }

        function dateMessage($fe_pago, $fe_plazo){
            $fecha  = mktime($fe_pago);
            $fecha2 = mktime($fe_plazo);

            if ($fecha != $fecha2) {
                return true;
            }

            return false;
        }

        function calDiasDeAtraso($dia, $mes, $año){  

            $fecha  = mktime(0,0,0,$mes,$dia,$año);
            $fecha2 = mktime(4,12,0,date('m'),date('d'),date('Y'));

            $calDiferencia = $fecha - $fecha2;
            
            $value = $calDiferencia / (60 * 60 * 24);
            $value = abs($value);
            $value = floor($value);
                        
            $this -> DiasAtraso = $value;
        }

        function cuotaFija(){
            $this -> cuota = $this -> monto * ((pow(1+$this->interes,$this->plazo)*$this->interes) / (pow(1+$this->interes,$this->plazo)-1)); 
        }

        function reacomodarFecha($fecha){
            $this -> fe_asignado = $fecha;

            $año = $this -> separateDate(2);
            $mes = $this -> separateDate(5);
            $dia = $this -> separateDate(8);

            return $dia. '-' . $this -> ceros($mes) . '-' . $año;
        }

        function separateDate($n){
            $result = '';
    
            for ($i = $n; $i <= $n+1; $i++) 
                $result .= $this -> fe_asignado[$i];

            if ($n === 2) 
                $result = (int)'20'. $result;
            
            return (int)$result;
        }

        function differenceDate($fecha){
            $fecha_actual  = strtotime(date('d-m-Y'));
            $fecha_entrada = strtotime($fecha);

            if($fecha_actual > $fecha_entrada){return true;}
            else if ($fecha_actual == $fecha_entrada){return NULL;}
                
            return false;
        }

        function dateValidate($fecha,$fecha2){
            $fecha_actual  = strtotime($fecha2);
            $fecha_entrada = strtotime($fecha);

            if($fecha_actual <= $fecha_entrada)
                return true;
            
            return false;
        }

        function calInteresTotal(){
            $this -> interesTotal = ($this -> plazo * $this -> cuota) - $this -> monto;
        }

        function generarMovimiento($accion, $cantidad, $descripcion){
            $movimientos = new MovimientosModel();

            $movimientos -> setNum_client($this -> num_client);
            $movimientos -> setCargo($accion);      
            $movimientos -> setDescripcion($descripcion);
            $movimientos -> setMonto($cantidad);      
            $movimientos -> setSaldo(); 

            if ($movimientos -> generarMovimiento()) {
                return true;
            }

            return false;
        }

        function updateSaldo($cant, $saldo){
            $nuevoSaldo = $saldo - $cant;

            try {
                $query = $this -> prepare('UPDATE cuenta SET saldo = :saldo WHERE num_client = :num_client');
                $query -> execute(['saldo' => $nuevoSaldo, 'num_client' => $this -> num_client]);

                return true;

            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function ceros($value){return str_pad($value, 2, "0", STR_PAD_LEFT);}
        function decimales($value){return number_format($value, 2, '.', '');}

        function from($array){
            $this -> num_client    = $array['num_client'];
            $this -> num_prestamo  = $array['num_prestamo'];
            $this -> monto         = $array['monto'];
            $this -> interes       = $array['interes']/12;
            $this -> plazo         = $array['plazo'];
            $this -> fe_asignado   = $array['fe_asignado'];
            $this -> status        = $array['status'];
        }
    }

?>