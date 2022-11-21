<?php

    if (session_status() == PHP_SESSION_NONE)
        session_start();

    require_once '../libs/database.php';
    require_once '../config/config.php';
    require_once '../libs/model.php';
    require_once '../libs/imodel.php';
    require_once '../models/usermodel.php';
    require_once '../models/updateinfomodel.php';

    function validateData($params){
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_#@.áéíóú ";

        foreach ($params as $param) {
            if(empty($_POST[$param]))
                return true;
            for ($j=0; $j < strlen($_POST[$param]); $j++){
                if (strpos($characters, substr($_POST[$param],$j,1)) === false)
                    return true;
            }
        }

        return false;
    }

    function existPOST($params){
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                return false;
            }
        }

        return true;
    }


    function isNumeric($params){

        foreach ($params as $param) {
            if(is_float($_POST[$param]*1)){
                return false;
            }

            if ($_POST[$param] > 1 || $_POST[$param] < 0) {
                return false;
            }
        }

        return true;
    }

    if (existPOST(['pass','newpass','newpassconfirm'])) {
        if (!validateData(['pass','newpass','newpassconfirm'])) {
            
            if ($_POST['pass'] !== $_POST['newpass']) {
                if ($_POST['newpass'] === $_POST['newpassconfirm']) {
                    $query = new UpdateInfoModel();
                    $data = $query -> newPassword($_POST['pass'],$_POST['newpass']) ? [true,"La contraseña se ha cambiado con existo"] : [false,"Contraseña incorrecta intentelo de nuevo"];
                } else {
                    $data = [false, "La nueva contraseña y la contraseña de confirmación deben coincidir"];
                }
            } else {
                $data = [false, "La nueva contraseña no puede se igual a tu antiguo password."];
            }
            
            echo json_encode($data);
        } else {
            $data = [false, "Asegurese de haber ingresado correctamente los datos"];
            
            echo json_encode($data);
        }

    }

    if (existPOST(['validacion','cobro'])) {
        if (isNumeric(['validacion', 'cobro'])) {
            $query = new UpdateInfoModel();
            $data = $query -> updateConfiguration($_POST['validacion'],$_POST['cobro']) ? [true,"Se ha actualizado correctamente."] : [false,"No se ha podido actualizar."];

            echo json_encode($data);
        } else {
            $data = [false, "Hubo un error al guardar la información"];
            
            echo json_encode($data);
        }

    }

    if (existPOST(['promociones','sesion', 'movimientos'])) {
        if (isNumeric(['promociones','sesion', 'movimientos'])) {
            $query = new UpdateInfoModel();
            $data = $query -> updateNotifications($_POST['movimientos'],$_POST['sesion'],$_POST['promociones']) ? [true,"Se ha actualizado correctamente."] : [false,"No se ha podido actualizar."];
            
            echo json_encode($data);
        } else {
            $data = [false, "Hubo un error al guardar la información"];
            
            echo json_encode($data);
        }
    }
?>