<?php 
    $loan = $this -> d['payment']; 
    $url = $_GET['url'];
    $url = rtrim($url, '/');
    $url = explode('/', $url);
?>

<link rel="stylesheet" href="<?php echo constant('URL')?>public/css/pagos.css">

<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Pagos de creditos</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL') . $url[0];?>/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>    
        </div>
        <hr>
        <div class="modal-body">
            
            <form action="<?php echo constant('URL') . $url[0];?>/pagar" method="POST">
                <input type="hidden" name="accion" value="3">
                <input type="hidden" name="num_prestamo" value="<?php echo $this -> d['num_prestamo']; ?>">
                <div class="montos">
                    <h3>Seleccione el monto a pagar: </h3>    

                    <p class="sub-title">Pagar mesualidad <?php echo $loan['plazo'] . '/' . $loan['plazos']; ?></p>
                    <input type="radio" name="pago" id="2" value="<?php echo $loan['pago'] ?>">
                    <label for="2">
                        <p>Cuota: $<?php echo $loan['pago'] - $loan['interes'];; ?></p>
                        <p>Intereses: $<?php echo $loan['interes']; ?></p>
                        <div class="btn-submit">
                            <p>Total: $<?php echo $loan['pago']; ?></p>
                        </div>
                    </label>

                    <p class="sub-title">Pagar el total de la deuda</p>
                    <input type="radio" name="pago" id="1" value="<?php echo $loan['total'] ?>">
                    <label for="1">
                        <p>Intereses: $<?php echo $loan['interes']; ?></p>
                        <div class="btn-submit">
                            <p>Total: $<?php echo $loan['total'] ?></p>
                        </div>
                    </label>
                    
                </div>
                <div class="btn-submit">
                    <button type="submit" class="btn-Success">Pagar</button>
                </div>
            </form>
        </div>
    </div>
</div>