<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Depositos</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL');?>ver/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
        </div>
        <div class="modal-body">
            <hr>
            <form action="<?php echo constant('URL');?>ver/deposito" method="POST">
                <input type="hidden" name="accion" value="5">
                <input type="number" name="clabe" id="clabe" placeholder="Ingrese la cuenta clabe">
                <input type="number" name="cant" id="cant" placeholder="Ingrese la cantidad a enviar">
                <div class="content-button">
                    <button type="submit" class="btn-Success">Generar deposito</button>
                </div>            
            </form>
        </div>
    </div>
</div>
