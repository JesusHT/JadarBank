<?php  
    $accountClient = $this -> d['cuenta'];
?>
<style>
     .modal-content {
        transform: translate(0%, 0%)!important;
     }
</style>

<div id="retiro" class="modal">
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
            <form action="" method="POST">
                <input type="hidden" name="accion" value="trasferencia">

                <!-- DESTINATARIO -->
                <div id="Destinatario" class="activo">
                    <h3>Destinatario (1-3)</h3>
                    <button type="button" class="btn" id="btn-nuevo">Nuevo</button>
                    <div id="nuevo">
                        <input type="number" name="clabeInterbancaria" id="clabeInterbancaria" class="mb-1" placeholder="Ingrese la clabe interbancaria">
                        <input type="text"   name="alias" id="alias"                           class="mb-1" placeholder="Ingrese el alias">
                        <div class="content-button">
                            <button type="button" id="return"  class="btn">Regresar</button>
                            <button type="button" id="guardar" class="btn">Guardar</button>
                        </div>
                    </div>
                    <div class="guardados" id="guardados">
    
                    </div>
                </div>

                <!-- IMPORTE -->
                <div id="Importe">
                    <h3>Importe (2-3)</h3>
                    <input type="number" name="cantidad" id="cantidad">

                    <div class="content-button">
                        <button type="button" class="btn" id="btn-importe">Continuar</button>
                    </div>
                </div>

                <!-- Motivo -->
                <div id="Motivo">
                    <h3>Motivo de pago (3-3)</h3>
                    <input type="text" name="motivo" id="motivo">

                    <div class="content-button">
                        <button type="submit" class="btn">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo constant('URL')?>public/js/transferencias.js"></script>