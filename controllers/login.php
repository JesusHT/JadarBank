<?php

    class Login extends Controller {

        function __construct(){
            parent::__construct();

            $this -> existSESSION();

            $this -> view -> render('login/index');
        }

        function authenticate(){
            if ($this -> existPOST(['email','pass'])) {
                
                if ($this -> validateData(['email','pass'])) {
                    $this->redirect('', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }
                
                $email = $this -> getPost('email');
                $pass  = $this -> getPost('pass');

                $user = $this->model->login($email, $pass);

                
                if ($user === NULL) {
                    $this->redirect('', ['error' => Errors::ERROR_LOGIN_AUTHENTICATE]);
                    return;
                } 
                
                $session = new SessionController();
                $session -> setCurrentUser($user -> getId(), $user -> getRole());

                if ($user -> getRole() === 'user') {
                    $this -> redirect('main');
                    return;
                } else if($user -> getRole() === 'admin'){
                    $this -> redirect('admin');
                    return;
                }

            } else {
                $this->redirect('', ['error' => Errors::ERROR_LOGIN]);
            }
        }

        function logout(){
            $session = new SessionController();
            $session -> closeSession();
        }
    }

?>