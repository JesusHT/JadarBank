<?php  
    $accountClient = $this -> d['cuenta'];
    $contacts      = $this -> d['contactos'];
?>
<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Tranferencias</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL');?>/main/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
        </div>
        <div class="modal-body">
            <hr>
            <input type="hidden" name="saldo" id="saldo" value="<?php echo $accountClient['saldo']; ?>">
            <form action="<?php echo constant('URL');?>main/trasferencia" method="POST">
                <input type="hidden" name="accion" value="1">

                <!-- DESTINATARIO -->
                <div id="Destinatario" class="activo">
                    <h3>Destinatario (1-3)</h3>
                    <button type="button" class="btn" id="btn-nuevo"><i class="fa-sharp fa-solid fa-plus"></i></button>
                    <div id="nuevo">
                        <input type="number" name="clabeInterbancaria" id="clabeInterbancaria" class="mb-1" placeholder="Ingrese la clabe interbancaria">
                        <input type="text"   name="alias" id="alias"                           class="mb-1" placeholder="Ingrese el alias">
                        <div class="content-button">
                            <button type="button" id="return"  class="btn">Regresar</button>
                            <button type="button" id="guardar" class="btn-Success" disabled>Continuar</button>
                        </div>
                    </div>
                    <div class="guardados" id="guardados">
                        <?php if ($contacts !== NULL) echo $contacts;?>
                        <div class="content-button">
                            <button type="button" id="btn-select" class="btn-Success" disabled>Continuar</button>
                        </div>
                    </div>
                </div>

                <!-- IMPORTE -->
                <div id="Importe">
                    <h3>Importe (2-3)</h3>
                    <input type="number" name="cantidad" id="cantidad">
                    <span>En tu cuenta tienes: $<?php echo $accountClient['saldo']; ?> mxn</span>

                    <div class="content-button">
                        <button type="button" class="btn-Success" id="btn-importe" disabled>Continuar</button>
                    </div>
                </div>

                <!-- Motivo -->
                <div id="Motivo">
                    <h3>Motivo de pago (3-3)</h3>
                    <input type="text" name="motivo" id="motivo">

                    <div class="content-button">
                        <button type="submit" class="btn-Success">Transferir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo constant('URL')?>public/js/transferencias.js"></script>