<?php
    include_once './Includes/Dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;

    class EstadoDeCuenta extends Controller {

        private $cuenta;

        function __construct(){
            parent::__construct();

            if (isset($_SESSION['ver'])) {
                $this -> cuenta = new EstadosModel($_SESSION['ver']);
                $url            = 'ver';
            } else {
                $this -> cuenta = new EstadosModel($_SESSION['user']);
                $url            = 'main';
            }

            $this -> view -> render('templates/estadodecuenta',[
                'data' => $this -> cuenta -> getData(),
                'url'  => $url
            ]);
        }

        function generarPDF(){
            
            $dompdf = new Dompdf();
            ob_start();

            $this -> loadTemplate();
            
            $html = ob_get_clean();
            $dompdf->loadHtml($html);
            $dompdf->render();
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=Tabla De Amortización.pdf");
            echo $dompdf->output();
        }

        function loadTemplate(){
            $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "logo.jpg"));

            $this -> view -> render('templates/estadodecuentadescarga',[
                'data' => $this -> cuenta -> getData(),
                'logo' => $imagenBase64
            ]);
        }
    }
    
?>