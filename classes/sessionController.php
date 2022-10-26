<?php

    class SessionController {
        
        private $sessionName = 'user';
        private $sessionRole = 'role';
        
        function __construct(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

        public function setCurrentUser($user,$role){
            $_SESSION[$this->sessionName] = $user;
            $_SESSION[$this->sessionRole] = $role;
        }
    
        public function getCurrentUser(){
            return $_SESSION[$this->sessionName];
        }
    
        public function closeSession(){
            session_unset();
            session_destroy();
            header("Location:" . constant('URL'));
        }
    
        public function exists(){
            return isset($_SESSION[$this->sessionName]);
        }
    }
?>