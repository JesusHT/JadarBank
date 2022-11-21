<?php

    class Errors {
        // ERROR_CONTROLLER_METHOD_ACTION
        
        const ERROR_LOGIN                            = "11c37cfab311fbe28652f4947a9523c4";
        const ERROR_LOGIN_AUTHENTICATE               = "2194ac064912be67fc164539dc435a42";
        
        const ERROR_ADMIN_PASS                       = "bibf47d6b26a97f75bfcfd2e63e6497d";
        const ERROR_ADMIN_UPDATE                     = "bibf47d6b20123dccf2234d7cd3e647d";
        const ERROR_REQUESTS_CUSTOMERS               = "ibf47dj3gsibibf47ahjibihj3gsigjb";
        
        const ERROR_LOAN                             = "219pjksdjoahud912iuh9ehjahd8912h";
        const ERROR_PRESTAMOS_CANT                   = "hj3gsigd8ssahjdg2f38dsga87d8bg82";
        const ERROR_PRESTAMOS_STATUS                 = "hj3gsibibf47ahjdasdqdg2f38daga87";
        
        const ERROR_SESSION                          = "123dccfd26681sibf68123dwdas234d7";
        
        const ERROR_SIGNUP                           = "sdjhkskdjahdowjmdioendoinklajssd";
        const ERROR_SIGNUP_NEWUSER                   = "1fdce6bbf47d6b26a9cd809ea1910222";
        const ERROR_SIGNUP_NEWUSER_AGE               = "dklsahjksah12bhnd83buibd9bajk93b";
        const ERROR_SIGNUP_NEWUSER_PASS              = "ajshwcfd26e06d0122668109526734h8";
        const ERROR_SIGNUP_NEWUSER_EXISTS            = "a74accfd26e06d012266810952678cf3";

        const ERROR_IMG                              = "k2ddasibf47d6b26a9cd809ea1913902";
        const ERROR_DATA                             = "alknds81slh23hkjbn26a9g5b5cwdj42";
        const ERROR_DATA_EMPTY                       = "a5bcd7089d83f45e17e989fbc86003ed";
        const ERROR_DATA_FORMAT_STRING               = "6d01221233076b26acfd207f75bfa9cd";
        
        const ERROR_NOEXIST_CLIENT                   = "2194aalknd11c37cf678cf3adad3as81";
        const ERROR_RETIRO                           = "6d01221233076b2611c37cf678cf3ada";
        const ERROR_ACTION                           = "2194aal26d01221alknds81slh23hkas";
        const ERROR_NOEXIST_NUM_ACCOUNT              = "a9cd22126d01221232194aalknd11307";


        private $errorsList = [];

        public function __construct(){
            
            $this -> errorsList = [

                # Errores de Login
                Errors::ERROR_LOGIN                             => 'Hubo un problema al autenticarse',
                Errors::ERROR_LOGIN_AUTHENTICATE                => 'La contraseña y/o el correo son incorrectos. Intente nuevamente.',

                # Errores de Admin
                Errors::ERROR_ADMIN_PASS                        => 'Contraseña incorrecta!',
                Errors::ERROR_ADMIN_UPDATE                      => 'Hubo un error al actualizar el cliente',
                Errors::ERROR_REQUESTS_CUSTOMERS                => 'La solicitud de alta ya fue antida.',

                # Errores de prestamos
                Errors::ERROR_PRESTAMOS_CANT                    => 'La cantidad del prestamo debe ser minimo 100 pesos y maximo 1,000,000 pesos',
                Errors::ERROR_LOAN                              => 'No dispones de suficiente linea de credito para relizar esta operación',
                Errors::ERROR_PRESTAMOS_STATUS                  => 'El cliente tiene un adeudo!',
                
                # Errores de sesión 
                Errors::ERROR_SESSION                           => 'NO HAS INICIADO SESIÓN!',
                
                # Errores de Registro
                Errors::ERROR_SIGNUP                            => 'No se ha podido dar de alta el cliente. Intentelo más tarde por favor.',
                Errors::ERROR_SIGNUP_NEWUSER                    => 'Hubo un error al intentar registrarte. Intenta de nuevo',
                Errors::ERROR_SIGNUP_NEWUSER_AGE                => 'Debes de ser mayor de edad para poder registrarte.',
                Errors::ERROR_SIGNUP_NEWUSER_PASS               => 'Ambas contraseñas deben coicidir',
                Errors::ERROR_SIGNUP_NEWUSER_EXISTS             => 'El nombre de usuario ya existe, selecciona otro',
                
                #Errores de datos 
                Errors::ERROR_IMG                               => 'Hubo un error al ingresar el dato de imagen',
                Errors::ERROR_DATA                              => 'El formato de los datos es incorrecto.',
                Errors::ERROR_DATA_EMPTY                        => 'Los campos no pueden estar vacios. Asegurese de haber ingresado correctamente los datos.',
                Errors::ERROR_DATA_FORMAT_STRING                => 'La petición no puede contener strings',
                
                # Otros Errores
                Errors::ERROR_NOEXIST_CLIENT                    => 'No existe el cliente!',
                Errors::ERROR_ACTION                            => 'No se ha podido realizar el movimiento, intentelo mas tarde.',

                Errors::ERROR_RETIRO                            => 'No dispones de la cantidad suficiente para hacer esta transacción.',
                Errors::ERROR_NOEXIST_NUM_ACCOUNT               => 'No existe la cuenta clabe ingresada, asegurse de haber ingresado correctamente el dato.'

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