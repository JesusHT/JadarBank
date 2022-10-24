<?php

    
    class View {

        function __construct(){
        }

        function render($nombre, $data = []){
            $this->d = $data;
            $this->handleMessages();
            
            if (!empty($_GET['url']) && $_GET['url'] !== 'recuperar') {
                require_once 'config/session.php';
            }

            require 'views/' . $nombre . '.php';
        }
        
        private function handleMessages(){
            //if(isset($_GET['success']) && isset($_GET['error'])){}       
            if(isset($_GET['success'])){
                $this->handleSuccess();
            } else if(isset($_GET['error'])){
                $this->handleError();
            } else if(isset($_GET['info'])){
                $this->handleInfo();
            } else if(isset($_GET['warning'])){
                $this->handleWarning();
            }
        }

        private function handleError(){
            if(isset($_GET['error'])){
                $hash = $_GET['error'];
                $errors = new Errors();

                if($errors->existsKey($hash)){
                    $this->d['error'] = $errors->get($hash);
                }else{
                    $this->d['error'] = NULL;
                }
            }
        }

        private function handleSuccess(){
            if(isset($_GET['success'])){
                $hash = $_GET['success'];
                $success = new Success();

                if($success->existsKey($hash)){
                    $this->d['success'] = $success->get($hash);
                }else{
                    $this->d['success'] = NULL;
                }
            }
        }

        private function handleWarning(){
            if(isset($_GET['warning'])){
                $hash = $_GET['warning'];
                $warnings = new Warning();

                if($warnings->existsKey($hash)){
                    $this->d['warning'] = $warnings->get($hash);
                }else{
                    $this->d['warning'] = NULL;
                }
            }
        }

        private function handleInfo(){
            if(isset($_GET['info'])){
                $hash = $_GET['info'];
                $info = new Info();

                if($info->existsKey($hash)){
                    $this->d['info'] = $info->get($hash);
                }else{
                    $this->d['info'] = NULL;
                }
            }
        }

        public function showMessages(){
            $this->showError();
            $this->showSuccess();
            $this->showInfo();
            $this->showWarning();
        }

        public function showError(){
            if(array_key_exists('error', $this->d)){
                echo '<div class="bg-Error">'.$this->d['error'].'</div>';
            }
        }

        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
                echo '<div class="bg-Success">'.$this->d['success'].'</div>';
            }
        }

        public function showInfo(){
            if(array_key_exists('info', $this->d)){
                echo '<div class="bg-Info">'.$this->d['info'].'</div>';
            }
        }

        public function showWarning(){
            if(array_key_exists('warning', $this->d)){
                echo '<div class="bg-Warning">'.$this->d['warning'].'</div>';
            }
        }
    }
    
?>