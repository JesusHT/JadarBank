<?php

    class Controller {
        
        function __construct(){
            $this -> view = new View();
        }

        function loadModel($model){
            $url = 'models/'.$model.'model.php';
    
            if(file_exists($url)){
                require $url;
    
                $modelName = $model.'Model';
                $this -> model = new $modelName();
            }
        }

        function existPOST($params){
            foreach ($params as $param) {
                if(!isset($_POST[$param])){
                    return false;
                }
            }

            return true;
        }

        function getGet($name){
            return $_GET[$name];
        }
    
        function getPost($name){
            return $_POST[$name];
        }

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

        function validateImg($img){
            $archivo = basename($img["name"]);
            $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            
            if($tipoArchivo != "jpg"){ return true; }

            $checarSiImagen = getimagesize($img["tmp_name"]);

            if($checarSiImagen === true){ return true; }

            if ($img["size"] > 500000) { return true; }


            return false;
        }

        function redirect($route, $mensajes = []){
            $data = [];
            $params = '';
            
            foreach ($mensajes as $key => $value) {
                array_push($data, $key . '=' . $value);
            }
            $params = join('&', $data);
            
            if($params != ''){
                $params = '?' . $params;
            }
            
            header('location: ' . constant('URL') . $route . $params);
        }
    }
    
?>