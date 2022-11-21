<?php  
    $accountClient = $this -> d['cuenta'];
?>
<style> 
    .modal-content {transform: translate(0%, 100px)!important;}
</style>

<div id="retiro" class="modal">
    <?php $this -> showMessages();?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="title">
                <h2>Prestamo personal</h2>
            </div>
            <div class="closed">
                <a href="<?php echo constant('URL');?>/main/cerrar"><i class="fa-solid fa-circle-xmark"></i></a>
            </div>
        </div>
        <div class="modal-body">
            <hr>
            <h3 class="mt-1 text-center ">Simular prestamos</h4>
            <input type="hidden" id="credito" value="<?php echo $accountClient['credito'] - $accountClient['usado']; ?>">
            <form action="<?php echo constant('URL');?>main/generateLoan" method="POST" id="form-prestamos">
                <input type="hidden" name="accion" value="2">
                <div class="content-form">
                    <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad en pesos" required>
                    <span tabindex="0" data-descr="Crédito disponible: $<?php echo $accountClient['credito'] - $accountClient['usado']; ?> mxn"><i class="fa-sharp fa-solid fa-circle-info"></i></span>
                </div>
                <div id="reponse" class="content-input">
                    <label id="label1" for="1"> <input type="radio" name="plazo" id="1"   value="1"  required><span id="span1"></span></label>
                    <label id="label3" for="3"> <input type="radio" name="plazo" id="3"   value="3"  required><span id="span3"></span></label>
                    <label id="label6" for="6"> <input type="radio" name="plazo" id="6"   value="6"  required><span id="span6"></span></label>
                    <label id="label9" for="9"> <input type="radio" name="plazo" id="9"   value="9"  required><span id="span9"></span></label>
                    <label id="label12" for="12"><input type="radio" name="plazo" id="12" value="12" required><span id="span12"></span></label>
                </div>
                <p id="total"> </p>
                <div class="content-button">
                   <button type="submit" class="btn-Success mb-1">Solicitar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo constant('URL');?>public/js/load.js"></script>