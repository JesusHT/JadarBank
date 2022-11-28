<?php  $accountClient = $this -> d['cuenta'];?>
<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Tranferencias</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL');?>ver/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
        </div>
        <div class="modal-body">
            <hr>
            <input type="hidden" name="saldo" id="saldo" value="<?php echo $accountClient['saldo']; ?>">
            <form action="<?php echo constant('URL');?>ver/trasferencia" method="POST">
                <input type="hidden" name="accion" value="1">
                <input type="number" name="clabe" id="clabe" placeholder="Ingrese la cuenta clabe">
                <input type="number" name="cant" id="cant" placeholder="Ingrese la cantidad a enviar">
                <span>El cliente tiene: $<?php echo $accountClient['saldo']; ?> mxn</span>
                <input type="text" name="motivo" id="motivo" placeholder="Motivo">
                <div class="content-button">
                    <button type="submit" class="btn-Success">Transferir</button>
                </div>            
            </form>
        </div>
    </div>
</div>
