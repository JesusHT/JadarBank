<?php

    require './Includes/PHPMailer/email.php';

    class Nuevo extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $this -> view -> render('nuevo/index', []);
        }
        
        function newUser(){
            if ($this -> existPOST([
                'name',
                'fena',
                'curp',
                'pais',
                'codPostal',
                'estado',
                'ciudad',
                'domicilio',
                'tel',
                'email'
            ]) && isset($_FILES['img_client'])){
                if ($this -> validateData([
                    'name',
                    'fena',
                    'curp',
                    'pais',
                    'codPostal',
                    'estado',
                    'ciudad',
                    'domicilio',
                    'tel',
                    'email'
                ])) {
                    $this->redirect('nuevo', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }

                $fena = $this -> getPost('fena');
                
                if (!$this -> calEdad($fena)) {
                    $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_AGE]);
                    return;
                }

                $img_client = $_FILES['img_client'];

                if ($this -> validateImg($img_client)) {
                    $this -> redirect('nuevo', ['error' => Errors::ERROR_IMG]);
                    return;
                }

                $query = new UserModel();
                $email = $this -> getPost('email');

                if ($query -> exists($email)) {
                    $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                    return;
                }

                $name       = $this  -> getPost('name');
                $curp       = $this  -> getPost('curp');
                $pais       = $this  -> getPost('pais');
                $codPostal  = $this  -> getPost('codPostal');
                $estado     = $this  -> getPost('estado');
                $ciudad     = $this  -> getPost('ciudad');
                $domicilio  = $this  -> getPost('domicilio');
                $tel        = $this  -> getPost('tel');
                $pass       = $query -> createPass();

                $query -> setName($name);
                $query -> setFena($fena);
                $query -> setCurp($curp);
                $query -> setImg_Client($img_client);
                $query -> setPais($pais);
                $query -> setCodPostal($codPostal);
                $query -> setEstado($estado);
                $query -> setCiudad($ciudad);
                $query -> setDomicilio($domicilio);
                $query -> setTel($tel);
                $query -> setEmail($email);
                $query -> setPass($pass);
                $query -> setNum_client();
                $query -> setRole("user");
                $query -> setStatus("activo");

                $templates = new Templates();
                $email2    = new Email();

                $body = $templates -> newUser($name, $pass);

                if ($query -> save() && $query -> createAccount() ) {
                    if ($email2 -> sendMail($email, $name, "Bienvenido", $body)) {
                        $this->redirect('nuevo', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
                        return;
                    }
                }
            }

            $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP]);
        }
    }

?>