<?php

    class Login extends Controller {

        function __construct(){
            parent::__construct();
            $this -> view -> render('login/index');
        }

        function authenticate(){
            if ($this -> existPOST(['email','pass'])) {
                
                if ($this -> validateData(['email','pass'])) {
                    $this->redirect('', ['error' => Errors::ERROR_LOGIN_LOGIN_EMPTY]);
                    return false;
                }
                
                $email = $this -> getPost('email');
                $pass  = $this -> getPost('pass');

                $user = $this->model->login($email, $pass);

                
                if ($user === NULL) {
                    $this->redirect('', ['error' => Errors::ERROR_LOGIN_LOGIN_DATA]);
                } 
                
                $session = new SessionController();
                $session -> setCurrentUser($user -> getId());

                if ($user -> getRole() === 'user') {
                    $this -> redirect('main');
                    return true;
                } else if($user -> getRole() === 'admin'){
                    $this -> redirect('admin');
                    return true;
                }


            } else {
                $this->redirect('', ['error' => Errors::ERROR_LOGIN_LOGIN]);
            }
        }

        function logout(){
            $session = new SessionController();
            $session -> closeSession();
        }
    }

?>