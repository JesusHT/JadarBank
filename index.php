<?php
    ob_start();

    require_once 'libs/database.php';
    require_once 'config/config.php';

    require_once 'classes/errors.php';
    require_once 'classes/success.php';
    require_once 'classes/info.php';
    require_once 'classes/warning.php';
    require_once 'classes/sessionController.php';
    require_once 'classes/templates.php';
    
    require_once 'libs/controller.php';
    require_once 'libs/model.php';
    require_once 'libs/imodel.php';
    require_once 'libs/view.php';
    require_once 'libs/app.php';
    
    require_once 'models/usermodel.php';
    require_once 'models/tableusersmodel.php';
    require_once 'models/tableprestamosmodel.php';
    require_once 'models/listasolicitudesmodel.php';
    require_once 'models/cuentasmodel.php';
    require_once 'models/updateinfomodel.php';
    require_once 'models/movimientosmodel.php';
    require_once 'models/loanmodel.php';
    require_once 'models/customersmodel.php';
    require_once 'models/estadosmodel.php';
    
    $app = new App();
?>