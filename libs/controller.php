<?php

    class Controller {

        private $fecha;
        private $calAño;
        private $calMes;
        private $calDia;
        private $edad;
        private $views;

        function __construct(){
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $this -> controllerVarSession();
            
            $this -> view = new View();
            $this -> views = [
                "admin" => ["admin", "nuevo", "transacciones", "prestamos", "editar", "ver", "tabla", "ayuda", "perfil", "solicitud"], 
                "user" =>  ["main", "acciones", "consulta", "ayuda", "perfil", "instrucciones"]];
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

        function validateNumeric($params){
            foreach($params as $param){
                if (empty($_POST[$param])) {
                    return true;
                }
                if (!is_numeric($_POST[$param])) {
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


        public function redirectRole(){
            if (isset($_SESSION['user'])) {
                if (!$this -> restrictViews()) {
                    if ($_SESSION['role'] === 'admin') {
                        $this -> redirect('admin');
                        return;
                    }
    
                    $this -> redirect('main');
                    return;
                } 
            } else {
                $this -> redirect('');
                return;
            }
        }

        public function existSESSION(){
            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] === 'admin') {
                    $this -> redirect('admin');
                    return;
                } 
                $this -> redirect('main');
                return;             
            } 
        }

        public function restrictViews(){
            for ($i=0; $i < count($this -> views[$_SESSION['role']]); $i++) { 
                if ($_GET['url'] === $this -> views[$_SESSION['role']][$i] || strpos($_GET['url'], $this -> views[$_SESSION['role']][$i]) === 0) {
                    return true;
                }
            }

            return false;
        }

        public function controllerVarSession(){
            if (!empty($_GET['url'])) {
                if ($_GET['url'] !== 'editar' && strpos($_GET['url'], 'editar') !== 0) {
                    unset($_SESSION['editar']);
                }

                if ($_GET['url'] !== 'ver' && strpos($_GET['url'], 'ver') !== 0) {
                    unset($_SESSION['ver']);
                }

                if ($_GET['url'] !== 'prestamo' && strpos($_GET['url'], 'prestamo') !== 0) {
                    unset($_SESSION['prestamo']);
                }

                if($_GET['url'] !== 'instrucciones' && strpos($_GET['url'], 'instrucciones') !== 0){
                    unset($_SESSION['accion']);
                }
            }
        }

        public function calFecha($n){
            $result = '';
       
            for ($i = $n; $i <= $n+1; $i++) {
                $result .= $this -> fecha[$i];
            }
        
            return $result;
        }

        public function calEdad($fecha){
            $this -> fecha  = $fecha;
            $this -> calAño = $this -> calFecha(2);
            $this -> edad   = abs($this -> calAño - date('y'));
            
            if ($this -> edad > 18) {
                return true;
            }

            $this -> calMes = $this -> calFecha(5);
            $this -> calDia = $this -> calFecha(8);
        
            if ($this -> edad === 18){
                if($this -> calMes < date('m')){
                    return true;   
                }
            
                if($this -> calMes === date('m') && $this -> calDia <= date('d')){
                    return true;
                }
            
                return false;
            }
        
            return false;
        }
    }
    
?>