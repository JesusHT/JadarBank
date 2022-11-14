<?php

    class Success {
        
        const SUCCESS_USER_UPDATEBUDGET     = "2ee085ac8828407f4908e4d134195e5c";
        const SUCCESS_USER_UPDATE           = "6fb34a5e4123fb823636ca24a1d21669";
        const SUCCESS_USER_UPDATEPASSWORD   = "6fb34a5e4118fb823636ca24a1d21669";
        const SUCCESS_USER_UPDATEPHOTO      = "edabc9e4581fee3f0056fff4685ee9a8";
        const SUCCESS_SIGNUP_NEWUSER        = "8281e04ed52ccfc13820d0f6acb0985a";
        const SUCCESS_ADMIN_DELETEUSER      = "8407f4908e4d134ccfc130f6acb0985a";
        const SUCCESS_LOAN_APPROVED         = "b0828988288407f4908e1e04407f485a";
        const SUCCESS_REQUEST_DENIED        = "840728988f4982884lkdjslj123kljdl";
        
        private $successList = [];

        public function __construct(){
            $this->successList = [
                Success::SUCCESS_USER_UPDATEBUDGET   => "Presupuesto actualizado correctamente",
                Success::SUCCESS_USER_UPDATE         => "Información del cliente actualizada correctamente!",
                Success::SUCCESS_USER_UPDATEPASSWORD => "Contraseña actualizado correctamente",
                Success::SUCCESS_USER_UPDATEPHOTO    => "Imagen de usuario actualizada correctamente",
                Success::SUCCESS_SIGNUP_NEWUSER      => "Usuario registrado correctamente",
                Success::SUCCESS_ADMIN_DELETEUSER    => "Usuario eliminado exitosamente",
                Success::SUCCESS_LOAN_APPROVED       => "Prestamo aprobado",
                Success::SUCCESS_REQUEST_DENIED      => "Solicitud rechazada correctamente"
            ];
        }

        function get($hash){
            return $this->successList[$hash];
        }

        function existsKey($key){
            if(array_key_exists($key, $this->successList)){
                return true;
            }else{
                return false;
            }
        }
    }
?>