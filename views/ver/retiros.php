<?php  $accountClient = $this -> d['cuenta'];?>
<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Retiros</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL');?>ver/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
        </div>
        <div class="modal-body">
            <hr>
            <input type="hidden" name="saldo" id="saldo" value="<?php echo $accountClient['saldo']; ?>">
            <form action="<?php echo constant('URL');?>ver/retiro" method="POST">
                <input type="hidden" name="accion" value="0">
                 <input type="hidden" name="num_client" id="num_client" value="<?php echo $accountClient['num_client']; ?>">
                 <input type="number" name="cant" id="cant">
                 <span>El cliente tiene: $<?php echo $accountClient['saldo']; ?> mxn</span>
                 <div class="content-button">
                    <button type="submit" class="btn-Success">Retirar</button>
                 </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo constant('URL'); ?>public/js/cliente.js"></script>