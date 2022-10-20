<?php

    class Info {

        private $infoList;

        public function __construct(){
            $this->infoList = [
                
            ];
        }

        function get($hash){
            return $this->warningList[$hash];
        }

        function existsKey($key){
            if(array_key_exists($key, $this->infoList)){
                return true;
            }else {
                return false;
            }
        }
    }
?>