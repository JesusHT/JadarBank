<?php

    class Warning {

        const WARNING_PRESTAMOS_SALDO = "11cdklajlksdjlajd289hidhioh411cs";

        private $warningList = [
            Warning::WARNING_PRESTAMOS_SALDO => "El cliente aún tiene saldo en su cuenta."
        ];

        public function __construct(){
            $this->successList = [];
        }
        
        function get($hash){
            return $this->warningList[$hash];
        }

        function existsKey($key){
            if(array_key_exists($key, $this->warningList)){
                return true;
            }else {
                return false;
            }
        }
    }

?>