<?php

    class Login extends Controller {

        function __construct(){
            parent::__construct();
            $this -> view -> render('login/index');
        }

        function login(){
            if ($this -> existPOST(['email','pass'])) {

                if ($this -> validateData(['email','pass'])) {
                    $this -> redirect('',['error' => Errors::ERROR_LOGIN_LOGIN_EMPTY ]);
                }

                $email = $this -> getPost('email');
                $pass  = $this -> getPost('pass');

                $user = $this->model->login($email, $pass);

                if ($user !== NULL) {
                    if ($user -> getRole() === 'user') {
                        $this -> redirect('home',[]);
                    } else if($user -> getRole() === 'admin'){
                        $this -> redirect('perfil',[]);
                    }
                } 

                $this->redirect('', ['error' => Errors::ERROR_LOGIN_LOGIN_DATA]);

            } else{
                $this->redirect('', ['error' => Errors::ERROR_LOGIN_LOGIN]);
            }
        }
    }

?>