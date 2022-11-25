<?php 

    class LoanModel extends Model {
        # Variable de tabla prestamo
        private $num_client   ;
        private $num_prestamo ;
        private $monto        ;
        private $interes      ;
        private $plazo        ;
        private $fe_asignado  ;
        private $status       ;

        private $fechaActual  ;
        private $calPagos     ;
        private $cuota        ;

        private $fechas       ;
        private $style        ;
        private $interesDia   ;
        private $diasPorMes   ;
        private $diasTotales  ;


        function __contruct(){
            parent::__contruct();

            $this -> diasPorMes  = [31,28,31,30,31,30,31,30,31,30,31,30];
            $this -> diasTotales = 0;

            $this -> fechaActual = date('d-m-Y');
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

        function calDatePayments($num_prestamo){
            $data  = '';
            $this -> cuotaFija();
            $this -> calPayments($num_prestamo);

            for ($i=1; $i <= $this -> plazo ; $i++) { 
                $data .= 
                    '<tr>
                        <td class="text-center">' . $i .'</td>
                        <td>'. $this -> fechas[$i] . '</td>
                        <td class="'. $this -> style[$i] .' text-center status"><i class="fa-solid fa-circle"></i></td>
                        <td>$'. $this -> decimales($this -> cuota)                          .'</td>
                        <td>$'. $this -> decimales($this -> interesDia[$i])                 .'</td>
                        <td>$'. $this -> decimales($this -> cuota + $this -> interesDia[$i]).'</td>
                    </tr>';
            }

            return $data;
        }

        function calPayments($num_prestamo){
            try {
                $query = $this -> prepare('SELECT * FROM pagos WHERE num_prestamo = :num_prestamo');
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

                $fecha = $dia. '-' . $mes . '-' . $año;

                $this -> fechas[$i] = $fecha;

                if (count($payments) > 0) {
                    foreach ($payments as $payment) {
                        if ($this -> dataValidate($fecha, $payment -> fecha)) {
                            $this -> style[$i]      = 'pagado';
                            $this -> interesDia[$i] = 0;
                        } else if($this -> differenceDate($fecha)){
                            $this -> style[$i] = 'atrasado';
                            $this -> interesDia[$i] = $this -> calInteres($dia, $mes, $año);
                        } else if($this -> differenceDate($fecha) === NULL){
                            $this -> style[$i] = 'pendiente';
                            $this -> interesDia[$i] = 0; 
                        } else {
                            $this -> style[$i] = '';
                            $this -> interesDia[$i] = 0;    
                        }
                    }
                } else {
                    if($this -> differenceDate($fecha)){
                        $this -> style[$i] = 'atrasado';
                        $this -> interesDia[$i] = $this -> calInteres($dia, $mes, $año);
                    } else if($this -> differenceDate($fecha) === NULL){
                        $this -> style[$i] = 'pendiente';
                        $this -> interesDia[$i] = 0; 
                    } else {
                        $this -> style[$i] = '';
                        $this -> interesDia[$i] = 0;    
                    }
                }   
            }
        }
        
        function calInteres($dia, $mes, $año){
            $this -> totalDias();
            $this -> calInteresTotal();

            $interes = $this -> interesTotal / $this -> diasTotales;
            $this -> calDiasDeAtraso($dia, $mes, $año);

            return $this -> DiasAtraso * $interes;
        }

        function calDiasDeAtraso($dia, $mes, $año){

            $fecha  = mktime(0,0,0,$mes,$dia,$año);
            $fecha2 = mktime(4,12,0,$this -> mes,$this -> dia,$this -> año);
            $calDiferencia = $fecha - $fecha2;
            $value = $calDiferencia / (60 * 60 * 24);
            $value = abs($value);
            $value = floor($value);

            $this -> DiasAtraso = $value;
        }

        function totalDias(){
            for ($i=0; $i < $this -> plazo; $i++) { 
                $this -> diasTotales += $this -> diasPorMes[$i];
            }
        }

        public function cuotaFija(){
            $this -> cuota = $this -> monto * ((pow(1+$this->interes,$this->plazo)*$this->interes) / (pow(1+$this->interes,$this->plazo)-1)); 
        }

        function separateDate($n){
            $result = '';
    
            for ($i = $n; $i <= $n+1; $i++) 
                $result .= $this -> fe_asignado[$i];

            if ($n === 2) 
                $result = (int)'20'. $result;
            else 
                $result = (int)$this -> ceros($result);
            
            return $result;
        }

        function differenceDate($fecha){
            $fecha_actual  = strtotime($this -> fechaActual);
            $fecha_entrada = strtotime($fecha);

            if($fecha_actual > $fecha_entrada)
                return true;
            else if ($fecha_actual == $fecha_entrada)
                return NULL;

            return false;
        }

        function dateValidate($fecha,$fecha2){
            $fecha_actual  = strtotime($fecha2);
            $fecha_entrada = strtotime($fecha);

            if($fecha_actual >= $fecha_entrada)
                return true;
            
            return false;
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