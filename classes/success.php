<?php

    class Success {
        
        const SUCCESS_USER_UPDATEBUDGET     = "2ee085ac8828407f4908e4d134195e5c";
        const SUCCESS_USER_UPDATENAME       = "6fb34a5e4118fb823636ca24a1d21669";
        const SUCCESS_USER_UPDATEPASSWORD   = "6fb34a5e4118fb823636ca24a1d21669";
        const SUCCESS_USER_UPDATEPHOTO      = "edabc9e4581fee3f0056fff4685ee9a8";
        const SUCCESS_SIGNUP_NEWUSER        = "8281e04ed52ccfc13820d0f6acb0985a";
        
        private $successList = [];

        public function __construct()
        {
            $this->successList = [
                Success::SUCCESS_USER_UPDATEBUDGET   => "Presupuesto actualizado correctamente",
                Success::SUCCESS_USER_UPDATENAME     => "Nombre actualizado correctamente",
                Success::SUCCESS_USER_UPDATEPASSWORD => "Contraseña actualizado correctamente",
                Success::SUCCESS_USER_UPDATEPHOTO    => "Imagen de usuario actualizada correctamente",
                Success::SUCCESS_SIGNUP_NEWUSER      => "Usuario registrado correctamente"
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