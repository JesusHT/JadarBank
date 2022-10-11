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
                $this->model = new $modelName();
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