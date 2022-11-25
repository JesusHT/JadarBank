<?php 
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
            <hr>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <input type="hidden" name="num_prestamo">
                <div class="montos">
                    <input type="radio" name="pago" id="1" value="<?php echo $this -> d['total'] ?>">
                    <label for="1">
                        <p>Pagar el total de la deuda</p>
                        <p><?php echo $this -> d['total'] ?></p>
                    </label>
                    <input type="radio" name="pago" id="2" value="<?php echo $this -> d['cuota'] ?>">
                    <label for="2">
                        <p>Pagar mesualidad <?php echo $this -> d['Num'] + 1 . '/' . $this -> d['plazo']; ?></p>
                        <p><?php echo $this -> d['cuota'] ?></p>
                    </label>
                </div>

                <div class="btn-submit">
                    <button type="submit" class="btn">Pagar</button>
                </div>
            </form>
        </div>
    </div>
</div>