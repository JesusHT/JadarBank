<?php

    class Registro extends Controller {
        
        function __construct(){
            parent::__construct();
            $this -> view -> render('registro/index');
        }

        function solicitud(){
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
                'email',
                'pass',
                'pass2'
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
                    'email',
                    'pass',
                    'pass2'
                ])) {
                    $this->redirect('registro', ['error' => Errors::ERROR_DATA_EMPTY ]);
                    return;
                }

                $fena = $this -> getPost('fena');
                
                if (!$this -> calEdad($fena)) {
                    $this -> redirect('registro', ['error' => Errors::ERROR_SIGNUP_NEWUSER_AGE]);
                    return;
                }

                $img_client = $_FILES['img_client'];

                if ($this -> validateImg($img_client)) {
                    $this->redirect('registro', ['error' => Errors::ERROR_IMG]);
                    return;
                }

                $query = new UserModel();
                $email = $this -> getPost('email');

                if ($query -> exists($email)) {
                    $this -> redirect('registro', ['error' => Errors::ERROR_SIGNUP_NEWUSER_EXISTS]);
                    return;
                }

                $pass       = $this -> getPost('pass');
                $pass2      = $this -> getPost('pass2');
                
                if ($pass !== $pass2){
                    $this -> redirect('registro', ['error' => Errors::ERROR_SIGNUP_NEWUSER_PASS]);
                    return;
                }

                $name       = $this -> getPost('name');
                $curp       = $this -> getPost('curp');
                $pais       = $this -> getPost('pais');
                $codPostal  = $this -> getPost('codPostal');
                $estado     = $this -> getPost('estado');
                $ciudad     = $this -> getPost('ciudad');
                $domicilio  = $this -> getPost('domicilio');
                $tel        = $this -> getPost('tel');

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
                $query -> setStatus("pendiente");

                if ($query -> save()) {
                    $this->redirect('registro', ['success' => Success::SUCCESS_SOLICITUD]);
                    return;
                }

                $this -> redirect('registro', ['error' => Errors::ERROR_IMG]);
    
            }

            $this -> redirect('registro', ['error' => Errors::ERROR_SIGNUP_NEWUSER]);
            return;
        }
    }
?>