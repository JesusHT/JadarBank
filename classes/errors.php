<?php

    class Errors {
        // ERROR_CONTROLLER_METHOD_ACTION
        const ERROR_LOGIN_LOGIN                      = "11c37cfab311fbe28652f4947a9523c4";
        const ERROR_LOGIN_LOGIN_EMPTY                = "2194ac064912be67fc164539dc435a42";
        const ERROR_LOGIN_LOGIN_DATA                 = "bcbe63ed8464684af6945ad8a89f76f8";
        const ERROR_SIGNUP_NEWUSER                   = "1fdce6bbf47d6b26a9cd809ea1910222";
        const ERROR_SIGNUP_NEWUSER_IMG               = "k2ddasibf47d6b26a9cd809ea1913902";
        const ERROR_SIGNUP_NEWUSER_EMPTY             = "a5bcd7089d83f45e17e989fbc86003ed";
        const ERROR_SIGNUP_NEWUSER_EXISTS            = "a74accfd26e06d012266810952678cf3";
        const ERROR_SIGNUP_NEWUSER_PASS              = "ajshwcfd26e06d0122668109526734h8";
        const ERROR_SESSION                          = "123dccfd26e06d0122668123dwdas234";
        const ERROR_ADMIN_DELETEUSER_DATA            = "b00d498123307f75bfcfd26ec06497d6";
        const ERROR_ADMIN_TABLEUSERS_FAILED          = "6d01221233076b26acfd207f75bfa9cd";

        private $errorsList = [];

        public function __construct(){
            
            $this->errorsList = [
                Errors::ERROR_LOGIN_LOGIN                       => 'Hubo un problema al autenticarse',
                Errors::ERROR_LOGIN_LOGIN_EMPTY                 => 'Asegurese de a ver ingresado correctamente los datos!',
                Errors::ERROR_LOGIN_LOGIN_DATA                  => 'Nombre de usuario y/o password incorrectos',
                Errors::ERROR_SIGNUP_NEWUSER                    => 'Hubo un error al intentar registrarte. Intenta de nuevo',
                Errors::ERROR_SIGNUP_NEWUSER_IMG                => 'Hubo un error al ingresar el dato de imagen',
                Errors::ERROR_SIGNUP_NEWUSER_EMPTY              => 'Los campos no pueden estar vacíos',
                Errors::ERROR_SIGNUP_NEWUSER_EXISTS             => 'El nombre de usuario ya existe, selecciona otro',
                Errors::ERROR_SIGNUP_NEWUSER_PASS               => 'Ambas contraseñas deben coicidir',
                Errors::ERROR_SESSION                           => 'NO HAS INICIADO SESIÓN!',
                Errors::ERROR_ADMIN_DELETEUSER_DATA             => 'Formato incorrecto de los datos',
                Errors::ERROR_ADMIN_TABLEUSERS_FAILED           => 'La petición no puede contener strings'
            ];
        }

        function get($hash){
            return $this->errorsList[$hash];
        }
    
        function existsKey($key){
            if(array_key_exists($key, $this->errorsList)){
                return true;
            }else{
                return false;
            }
        }
    }

?>