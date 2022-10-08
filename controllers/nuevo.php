<?php

    class Nuevo extends SessionController {
        
        function __construct(){
            parent::__construct();
        }

        function render(){
            $this -> view -> render('nuevo/index', []);
        }

        function newUser(){
            if ($this -> existPOST(['email','pass'])) {
                $email = $this -> getPost('email');
                $pass = $this -> getPost('pass');

                if ($email) {
                    # code...
                }
            } else {
                $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
            }
        }
    }

?>