<?php 
    $loan = $this -> d['loan']; 
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);
?>

<link rel="stylesheet" href="<?php echo constant('URL')?>public/css/desglose.css">

<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Desglose </h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL') . $url[0];?>/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>    
            <hr>
        </div>
        <div class="modal-body">
            <table>
                <thead>
                    <tr>
                        <td>Mensualidad</td>
                        <td>Vencimiento</td>
                        <td>Estatus</td>
                        <td>Monto</td>
                        <td>Interes</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $loan;?>
                </tbody>
            </table>
        </div>
    </div>
</div>