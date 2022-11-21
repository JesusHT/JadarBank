<div class="footer mt-2">
    <a id="configuracion" class="activo">Configuración</a>
    <a id="edit">Contraseña</a>
    <a id="notifications">Notifiaciones</a>
    <hr class="mb-2 mt-1">
                
    <p id="response"></p>

    <div class="active" id="configuracion-content">
        <div class="content-form">
            <form action="#" id="formConfiguracion">
                <div class="left">
                    <p>Verificación en 2 pasos</p>
                </div>
                <div class="right">
                    <input type="number" name="validacion" id="switch" class="<?php echo $styles[$config['validacion']];?>"  value="<?php echo $config['validacion'];?>">
                    <label for="switch"></label>
                </div>
                <span class="mt-2"></span>
                <div class="left">
                    <p>Cobro automático</p>  
                </div>
                <div class="right">
                    <input type="number" name="cobro" id="switch2" class="<?php echo $styles[$config['cobro']];?>" value="<?php echo $config['cobro'];?>">
                    <label for="switch2"></label>
                </div>
            </form>
        </div>
    </div>

    <div class="" id="edit-content">
        <form action="#" id="formPassword">
            <div class="content-inputs">
                <input type="password" name="pass"           id="pass"           placeholder="Ingrese su contraseña actual" required>
                <input type="password" name="newpass"        id="newpass"        placeholder="Ingrese su nueva contraseña"  required>
                <span id="demo"></span>
                <input type="password" name="newpassconfirm" id="newpassconfirm" placeholder="Confirme su nueva contraseña" required>
                <span id="demo2"></span>
            </div>
        </form>
    </div>

    <div class="" id="notifications-content">
        <div class="content-form">
            <form action="#" id="formNotifications">
                <div class="left">
                    <p>Enviar un email al realizar un movimiento (Transeferencias, retiros, prestamos, etc.).</p>
                </div>
                <div class="right">
                    <input type="number" name="movimientos" id="switch3" class="<?php echo $styles[$config['movimientos']];?>" value="<?php echo $config['movimientos'];?>">
                    <label for="switch3"></label>
                </div>
                <span class="mt-2"></span>
                <div class="left">
                    <p>Enviar un email cada vez que se inicie sesión.</p>  
                </div>
                <div class="right">
                    <input type="number" name="sesion" id="switch4" class="<?php echo $styles[$config['sesion']];?>" value="<?php echo $config['sesion'];?>">
                    <label for="switch4"></label>
                </div>
                <span class="mt-2"></span>
                <div class="left">
                    <p>Promociones.</p>  
                </div>
                <div class="right">
                    <input type="number" name="promociones" id="switch5" class="<?php echo $styles[$config['promociones']];?>" value="<?php echo $config['promociones'];?>">
                    <label for="switch5"></label>
                </div>
            </form>
        </div>
    </div>

    <div class="content-button">
        <button type="button" id="btn-submit" class="btn bg-success"><i class="fa-solid fa-floppy-disk"></i> Guardar </button>
    </div>
</div>

<script src="<?php echo constant('URL') . 'public/js/';?>profile.js"></script>