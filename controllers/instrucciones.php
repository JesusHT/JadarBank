<?php
    include_once './Includes/Dompdf/vendor/autoload.php';
    use Dompdf\Dompdf;

    class Instrucciones extends Controller {

        function __construct(){
            parent::__construct();
            $this -> redirectRole();

            if (!isset($_SESSION['accion'])) {
                $this -> redirect('main');
                return;
            }

            $this -> view -> render('instrucciones/index');
        }

        function generatePDF(){
            $dompdf = new Dompdf();
            ob_start();

            $this -> loadTemplate();

            $html = ob_get_clean();
            $dompdf->loadHtml($html);
            $dompdf->render();
            header("Content-type: application/pdf");
            header("Content-Disposition: inline; filename=Instrucciones de retiro.pdf");
            echo $dompdf->output();
        }

        function loadTemplate(){
            $logo1 = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "Oxxo.png"));
            $logo2 = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "Soriana.png"));
            $logo3 = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "Comercial.png"));
            $qr    = "data:image/png;base64," . base64_encode(file_get_contents(constant('URL-IMG') . "retiro.png"));
            

            $this -> view -> render('templates/instrucciones',[
                'logo1'      => $logo1,
                'logo2'      => $logo2,
                'logo3'      => $logo3,
                'num_client' => $_SESSION['num_client'],
                'cantidad'   => $_SESSION['cantidad'],
                'qr'         => $qr,
                'accion'     => $_SESSION['accion']
            ]);
            
        }

        function volver(){
            unset($_SESSION['accion']);
            unset($_SESSION['num_client']);
            unset($_SESSION['cantidad']);
            unset($_SESSION['ruta']);
            $this -> redirect('main');
        }
    }
?>