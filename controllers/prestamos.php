<?php
    include_once './Includes/Dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;

    class Prestamos extends Controller {
        
        private $cantPrestamo;
        private $plazo;
        private $interes;
        private $cuota;
        private $totalIntereses;
        private $tableHtml;

        function __construct(){
            parent::__construct();
            $this -> view -> render('prestamos/index');
            $this -> cuota          = 0;
            $this -> interes        = 0.075/12;
            $this -> totalIntereses = 0;
            $this -> tableHtml      = '';
        }

        public function calcular(){
            if ($this -> existPOST(['cantidad', 'plazo'])) {
                
                if ($this -> validateNumeric(['cantidad','plazo'])) {
                    $this -> redirect('prestamos', ['error' => Errors::ERROR_DATA]);
                    return;
                }

                $this -> cantPrestamo = $this -> getPost('cantidad');
                $this -> plazo        = $this -> getPost('plazo');   

                if ($this -> cantPrestamo < 99) {
                    $this -> redirect('prestamos', ['error' => Errors::ERROR_PRESTAMOS_CANT ]);
                    return;
                }

                $this -> cuotaFija();
                $this -> getTable('prestamos');
            }
        }

        public function cuotaFija(){
            $this -> cuota = $this -> cantPrestamo * ((pow(1+$this->interes,$this->plazo)*$this->interes) / (pow(1+$this->interes,$this->plazo)-1)); 
        }

        public function getTabla(){
            $temp = 0;
            $interesPoMes = 0;
            $abonoCapital = 0; 
            $total = $this -> cantPrestamo;

            for ($i=0; $i <= $this-> plazo; $i++) { 

                if ($i === 0){
                    $this -> tableHtml .= '
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
                    $this -> tableHtml .= '
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

            return strval($this -> tableHtml);
        }

        public function Decimales($value){
            return number_format($value, 2, '.', '');
        }

        public function descargarpdf(){
            
            $this -> cantPrestamo = $this -> getPost('cantidad');
            $this -> plazo        = $this -> getPost('plazo');
            
            $dompdf = new Dompdf();
            ob_start();

            $this -> cuotaFija();
            $this -> getTable('templates');
            
            $html = ob_get_clean();
            $dompdf->loadHtml($html);
            $dompdf->render();
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=Tabla De Amortización.pdf");
            echo $dompdf->output();
        }

        public function getTable($directory){
            $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "logo.jpg"));

            $this -> view -> render($directory.'/tabla',[
                'imagen'         => $imagenBase64,
                'tabla'          => $this -> getTabla(),
                'pago'           => $this -> Decimales($this -> cuota),
                'termino'        => $this -> plazo,
                'cantidad'       => $this -> cantPrestamo,
                'total'          => $this -> Decimales(round($this -> cantPrestamo + $this -> totalIntereses,1)),
                'totalIntereses' => $this -> Decimales(round($this -> totalIntereses, 1))
            ]);
        }
    }
?>