<?php 

    class LoanModel extends Model {

        private $num_client   ;
        private $num_prestamo ;
        private $monto        ;
        private $interes      ;
        private $plazo        ;
        private $fe_asignado  ;
        private $status       ;
        private $cuota        ;
        private $interesDia   ;
        private $interesTotal ;
        private $diasTotales  ;
        private $diasPorMes   ;

        function __construct(){
            parent::__construct();
            $this -> diasPorMes = [31,28,31,30,31,30,31,30,31,30,31,30];
            $this -> diasTotales = 0;
            $this -> interesDia = 0;
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

        function calDatePayments(){
            $data  = '';
            $style = '';
            $this -> cuotaFija();
            
            $año = $this -> calDate(2);
            $mes = $this -> calDate(5);
            $dia = $this -> calDate(8);


            for ($i=1; $i <= $this -> plazo ; $i++) { 
                if ($mes < 12) {
                    $mes += 1;
                } else {
                    $mes =  1;
                    $año += 1;
                }

                $style = $this -> validatePayment($mes, $año, $dia);

                $data .= '<tr>
                            <td class="text-center">' . $i .'</td>
                            <td>20' . $año . '-' . $this -> ceros($mes) . '-' . $this -> ceros($dia) . '</td>
                            <td class="'. $style .' text-center status"><i class="fa-solid fa-circle"></i></td>
                            <td>$'. $this -> decimales($this -> cuota)                      .'</td>
                            <td>$'. $this -> decimales($this -> interesDia)                 .'</td>
                            <td>$'. $this -> decimales($this -> cuota + $this -> interesDia).'</td>
                        </tr>';

                $style = '';
                $this -> interesDia = 0;
            }

            return $data;
        }

        function validatePayment($mes, $año, $dia){
            try {
                $query = $this -> prepare('SELECT * FROM pagos WHERE num_prestamo = :num_prestamo');
                $query -> execute(['num_prestamo' => $this -> num_prestamo]);
                $payments = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($payments) > 0) {
                    return true;
                }

                if (date('m') > $mes && date('y') == $año) {
                    $this -> calInteres($dia, $mes);
                    return 'atrasado';
                }

                if (date('m') == $mes && date('y') == $año) {
                    if (date('d') > $dia) {
                        $this -> calInteres($dia, $mes);
                        return 'atrasado';
                    }

                    if (date('d') == $dia) {
                        return 'pendiente';
                    }
                } 

            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        function calInteres($dias, $mes){
            $this -> totalDias();
            $this -> calInteresTotal();

            $interes = $this -> interesTotal / $this -> diasTotales;

            if (date('m') == $mes) {
                $this -> interesDia = (date('d') - $dias)*$interes;
            }
        }

        function totalDias(){
            for ($i=0; $i < $this -> plazo; $i++) { 
                $this -> diasTotales += $this -> diasPorMes[$i];
            }
        }

        function calInteresTotal(){$this -> interesTotal = ($this -> plazo * $this -> cuota) - $this -> monto;}

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
    }

?>