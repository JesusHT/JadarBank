<?php

    class Prestamos extends Controller {
        
        private $cantPrestamo;
        private $plazo;
        private $interes;
        private $cuota;
        private $totalIntereses;

        function __construct(){
            parent::__construct();
            $this -> view -> render('prestamos/index');
            $this -> cuota = 0;
            $this -> interes = 0.075/12;
            $this -> totalIntereses = 0;

        }

        public function calcular(){
            if ($this -> existPOST(['cantidad', 'plazo'])) {
                
                if(empty($this -> getPost('cantidad')) && empty($this -> getPost('cantidad'))){
                    $this -> redirect('prestamos');
                    return;
                }

                $this -> cantPrestamo = $this -> getPost('cantidad');
                $this -> plazo        = $this -> getPost('plazo');

                $this -> cuotaFija();
                
                $this -> view -> render('prestamos/tabla',[
                    'tabla'          => $this -> getTabla(),
                    'pago'           => $this -> Decimales($this -> cuota),
                    'termino'        => $this -> plazo,
                    'cantidad'       => $this -> cantPrestamo,
                    'total'          => $this -> Decimales(round($this -> cantPrestamo + $this -> totalIntereses,1)),
                    'totalIntereses' => $this -> Decimales(round($this -> totalIntereses, 1))
                ]);
            }


        }

        public function cuotaFija(){
            $this -> cuota = $this -> cantPrestamo * ((pow(1+$this->interes,$this->plazo)*$this->interes) / (pow(1+$this->interes,$this->plazo)-1)); 
        }

        public function getTabla(){
            $data = '';
            $temp = 0;
            $interesPoMes = 0;
            $abonoCapital = 0; 
            $total = $this -> cantPrestamo;
            for ($i=0; $i <= $this-> plazo; $i++) { 

                if ($i === 0){
                    $data .= '
                                <tr>
                                    <td>'. $i .'</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td> $'. $this -> cantPrestamo .'</td>
                                </tr>';
                } else {

                    $interesPoMes = $total * $this -> interes;
                    $this -> totalIntereses += $interesPoMes;
                    $abonoCapital = $this -> cuota - $interesPoMes; 
                    $temp = $abonoCapital - $total;
                    $data .= '
                            <tr>
                                <td class="celdas"> '  . $i                                 . '</td>
                                <td class="celdas"> $' . $this -> Decimales($total)         . '</td>
                                <td class="celdas"> $' . $this -> Decimales($this -> cuota) . '</td>
                                <td class="celdas"> $' . $this -> Decimales($interesPoMes ) . '</td>
                                <td class="celdas"> $' . $this -> Decimales($abonoCapital)  . '</td>
                                <td class="celdas"> $' . abs($this -> Decimales($temp))     . '</td>
                            </tr>
                    ';
                    
                    $total = abs($temp);
                }
            }

            return strval($data);
        }

        public function Decimales($value){
            return number_format($value, 2, '.', '');
        }
    
    }

    
?>