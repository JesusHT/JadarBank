<?php

    class Warning {

        private $warningList = [];

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