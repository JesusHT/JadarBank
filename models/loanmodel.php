<?php 

    class LoanModel extends Model {

        private $num_client     ;
        private $num_prestamo   ;
        private $monto          ;
        private $interes        ;
        private $plazo          ;
        private $fe_asignado    ;
        private $status         ;
        private $cuota          ;

        
        private $interesTotal   ;
        private $diasTotales    ;
        private $diasPorMes     ;
        
        private $interesDia     ;
        private $style          ;
        private $fechas         ;
        private $pagos          ;
        private $count          ;

        private $año            ;
        private $mes            ;
        private $dia            ;

        private $DiasAtraso     ;

        private $p_num_prestamo ;
        private $p_fecha        ;
        private $p_cant         ; 

        function __construct(){
            parent::__construct();
            $this -> diasPorMes  = [31,28,31,30,31,30,31,30,31,30,31,30];
            $this -> diasTotales = 0;
            $this -> p_fecha     = date('d-m-Y');
            $this -> año         = date('Y'); 
            $this -> mes         = date('m');
            $this -> dia         = date('d');
        }

        function ExistLoan($key){
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

        function payment(){
            try {
                $query = $this -> prepare('INSERT INTO pagos (num_prestamo, fecha, cant) VALUES (:num_prestamo, :fecha, :cant)');
                $query -> execute([
                    'num_prestamo' => $this -> p_num_prestamo,
                    'fecha'        => $this -> p_fecha,
                    'cant'         => $this -> p_cant
                ]);

                return true;
            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function calDatePayments(){
            $data  = '';
            $this -> cuotaFija();
            $this -> pagosVencidos($this -> fe_asignado, $this -> plazo, $this -> num_prestamo);

            for ($i=1; $i <= $this -> plazo ; $i++) { 
                $data .= '<tr>
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

        function aviso($num_client){
            try {
                $query = $this -> prepare("SELECT fe_asignado FROM prestamos WHERE num_client = :num_client AND status = 'pendiente'");
                $query -> execute(['num_client' => $num_client]);

                $results = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($results) > 0) {  
                    foreach ($results as $result) {
                        $this -> fe_asignado = $result -> fe_asignado;

                        $año = $this -> calDate(2);
                        $mes = $this -> calDate(5);
                        $dia = $this -> calDate(8);

                        $año = (int)'20'.$año;
                        $mes = (int)$mes;
                        $dia = (int)$dia;
                        $dia = $this -> ceros($dia);

                        $fecha = $dia.'-'.$this -> ceros($mes) .'-'. $año;

                        if ($this -> validarFechas($fecha)) {
                            return true;
                        } else if ($this -> validarFechas($fecha) === NULL){
                            return NULL;
                        }
                        
                    }
                }
                
                return false;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function pagosVencidos($fecha, $plazo, $num_prestamo){
            $this -> pagosAlDia($num_prestamo);

            $this -> fe_asignado = $fecha;
            $this -> plazo       = $plazo;

            $año = $this -> calDate(2);
            $mes = $this -> calDate(5);
            $dia = $this -> calDate(8);

            $año = (int)'20'.$año;
            $mes = (int)$mes;
            $dia = (int)$dia;
            $dia = $this -> ceros($dia);

            for ($i=1; $i <= $this -> plazo; $i++) { 
                
                if ($mes < 12) {
                    $mes += 1;
                } else {
                    $mes =  1;
                    $año += 1;
                }

                $fecha = $dia.'-'.$this -> ceros($mes) .'-'. $año;
                $this -> fechas[$i] = $fecha;

                if($this -> validarFechas($fecha)){
                    $this -> style[$i] = 'atrasado';
                    $this -> interesDia[$i] = $this -> calInteres($dia, $mes, $año);
                } else if($this -> validarFechas($fecha) === NULL){
                    $this -> style[$i] = 'pendiente';
                    $this -> interesDia[$i] = 0; 
                } else {
                    $this -> style[$i] = '';
                    $this -> interesDia[$i] = 0;    
                } 
            }

            for ($i=1; $i < $this -> count + 1; $i++) { 
                $this -> style[$i] = 'pagado';
            }

        }

        function pagosAlDia($num_prestamo){
            try {
                $query = $this -> prepare('SELECT * FROM pagos WHERE num_prestamo = :num_prestamo');
                $query -> execute(['num_prestamo' => $num_prestamo]);
                $payments = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($payments) <= 0) {
                    return false;
                }
            } catch (PDOException $e){
                echo $e;
                return false;
            }

            $this -> count = 0;

            foreach ($payments as $payment) {
                $this -> pagos[$this -> count] = $payment -> fecha;
                $this -> count += 1;
            }
        }

        function validarFechas($fecha){
            $fecha_actual  = strtotime($this -> p_fecha);
            $fecha_entrada = strtotime($fecha);

            if($fecha_actual > $fecha_entrada){
                return true;
            } else if ($fecha_actual == $fecha_entrada){
                return NULL;
            }

            return false;
        }

        function calInteres($dia, $mes, $año){
            $this -> totalDias();
            $this -> calInteresTotal();

            $interes = $this -> interesTotal / $this -> diasTotales;
            $this -> calDiasDeAtraso($dia, $mes, $año);

            return $this -> DiasAtraso * $interes;
        }

        function totalDias(){
            for ($i=0; $i < $this -> plazo; $i++) { 
                $this -> diasTotales += $this -> diasPorMes[$i];
            }
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

        function calInteresTotal(){
            $this -> interesTotal = ($this -> plazo * $this -> cuota) - $this -> monto;
        }

        function calDate($n){
            $result = '';
    
            for ($i = $n; $i <= $n+1; $i++) {
                $result .= $this -> fe_asignado[$i];
            }
            
            return $result;
        }

        public function cuotaFija(){
            $this -> cuota = $this -> monto * ((pow(1+$this->interes,$this->plazo)*$this->interes) / (pow(1+$this->interes,$this->plazo)-1)); 
        }

        function ceros($value){ return str_pad($value, 2, "0", STR_PAD_LEFT);}
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

        function setNum_prestamo($num_prestamo){ $this -> p_num_prestamo = $num_prestamo ;}
        function setCant($cant)                { $this -> p_cant = $cant                 ;}
    }

?>