<?php
    require './Includes/PHPMailer/email.php';

    class Recuperar extends Controller {
        private $email;
        private $customer;
        private $templates;
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('recuperar/index');

            $this -> email     = new Email();
            $this -> templates = new Templates();
            $this -> customer  = new UserModel();
        }
        
        function newpass(){
            if ($this -> existPOST(['email'])) {
                if ($this -> customer -> exists($_POST['email'])) {
                    
                    $newPass = $this -> customer -> createPass();
                    $this -> customer -> updatePass($_POST['email'], password_hash($newPass, PASSWORD_BCRYPT));
                    $this -> customer -> getUsersForEmail($_POST['email']);
                    $body = $this -> templates -> newPass($newPass, $this -> customer -> getName());

                    if ($this -> email -> sendMail($_POST['email'], $this -> customer -> getName() ,"Nuevo password", $body)) {
                        $this -> redirect('',['success' => Success::SUCCESS_NEWPASS_GENERATE]);
                        return;
                    }
                }

                $this -> redirect('recuperar', ['error' => Errors::ERROR_NOEXIST_CLIENT]);
            }
        }
    }
?>