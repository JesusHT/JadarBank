<?php

    class Nuevo extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('nuevo/index', []);
        }

        function newUser(){
            if ($this -> existPOST([
                'name',
                'edad',
                'fena',
                'curp',
                'pais',
                'codPostal',
                'estado',
                'municipio',
                'domicilio',
                'tel',
                'email',
                'pass',
                'pass2'
            ]) && isset($_FILES['img_client'])){
                if ($this -> validateData([
                    'name',
                    'edad',
                    'fena',
                    'curp',
                    'pais',
                    'codPostal',
                    'estado',
                    'municipio',
                    'domicilio',
                    'tel',
                    'email',
                    'pass',
                    'pass2'
                ])) {
                    $this->redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EMPTY]);
                    return;
                }

                $name       = $this -> getPost('name');
                $edad       = $this -> getPost('edad');
                $fena       = $this -> getPost('fena');
                $curp       = $this -> getPost('curp');
                $img_client = $_FILES['img_client'];

                if ($this -> validateImg($img_client)) {
                    $this->redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_IMG]);
                    return;
                }

                $pais       = $this -> getPost('pais');
                $codPostal  = $this -> getPost('codPostal');
                $estado     = $this -> getPost('estado');
                $municipio  = $this -> getPost('municipio');
                $domicilio  = $this -> getPost('domicilio');
                $tel        = $this -> getPost('tel');
                $email      = $this -> getPost('email');
                $pass       = $this -> getPost('pass');
                $pass2      = $this -> getPost('pass2');

                
                $query = new UserModel();
                if ($query -> exists($email)) {
                    $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                    return;
                }

                if ($pass !== $pass2){
                    $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER_PASS]);
                    return;
                }

                $query -> setName($name);
                $query -> setEdad($edad);
                $query -> setFena($fena);
                $query -> setCurp($curp);
                $query -> setImg_Client($img_client);
                $query -> setPais($pais);
                $query -> setCodPostal($codPostal);
                $query -> setEstado($estado);
                $query -> setMunicipio($municipio);
                $query -> setDomicilio($domicilio);
                $query -> setTel($tel);
                $query -> setEmail($email);
                $query -> setPass($pass);
                $query -> setNum_client($_SESSION['user']);
                $query -> setRole("user");

                if ($query -> save()) {
                    $this->redirect('nuevo', ['success' => Success::SUCCESS_SIGNUP_NEWUSER]);
                    return;
                }

                $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
    
            }

            $this -> redirect('nuevo', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
            return;
        }
    }

?>