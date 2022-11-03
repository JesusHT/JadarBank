<?php

    class Editar extends Controller{
        private $cliente;

        function __construct(){
            parent::__construct();
        
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }

            if (!isset($_SESSION['actualizar'])) {
                $this -> redirect('admin');
                return;
            }

            $query = new UserModel();
            $this -> cliente = $query -> get($_SESSION['actualizar'], NULL);
            
            $this -> view -> render('admin/editar', ['client' => $this -> cliente]);
        }

        public function update(){
            if ($this -> existPOST([
                'name',
                'fena',
                'curp',
                'pais',
                'codPostal',
                'estado',
                'ciudad',
                'domicilio',
                'passEjecutivo'
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
                    'passEjecutivo'
                ])) {
                    $this->redirect('editar', ['error' => Errors::ERROR_DATA_EMPTY]);
                    return;
                }

                $query = new UserModel();

                $name          = $this -> getPost('name');
                $fena          = $this -> getPost('fena');
                $curp          = $this -> getPost('curp');
                $pais          = $this -> getPost('pais');
                $codPostal     = $this -> getPost('codPostal');
                $estado        = $this -> getPost('estado');
                $ciudad        = $this -> getPost('ciudad');
                $domicilio     = $this -> getPost('domicilio');
                $passEjecutivo = $this -> getPost('passEjecutivo');

                
                if (!$query -> comparePasswords($passEjecutivo, $_SESSION['user'])) {
                    $this -> redirect('editar',['error'=> Errors::ERROR_ADMIN_PASS]);
                    return;
                }

                $img = $query -> getImg($_SESSION['actualizar']);

                if ($_FILES['img_client']['name'] != null){

                    $img_client = $_FILES['img_client'];

                    if ($this -> validateImg($img_client)){
                        $this->redirect('editar', ['error' => Errors::ERROR_IMG]);
                        return;
                    }

                    if (file_exists(constant('URL-IMG') . $img['img_client'])){
                        unlink(constant('URL-IMG') . $img['img_client']);
                    }

                    if (!$query -> setImg_Client($img_client)){
                        $this -> redirect('editar',['error' => Errors::ERROR_IMG]);
                        return;
                    }
                } else {
                    $this -> model -> setImg_client($img['img_client']);
                }
                
                $this -> model -> setName($name);
                $this -> model -> setFena($fena);
                $this -> model -> setCurp($curp);
                $this -> model -> setPais($pais);
                $this -> model -> setCodPostal($codPostal);
                $this -> model -> setEstado($estado);
                $this -> model -> setCiudad($ciudad);
                $this -> model -> setDomicilio($domicilio);

                if ($this -> model -> update($_SESSION['actualizar'])) {
                    $this -> redirect('editar',['success' => Success::SUCCESS_USER_UPDATE]);
                    return;
                }

            }
            
            $this -> redirect('editar',['error' => Errors::ERROR_ADMIN_UPDATE]);
            return;
        }

        public function volver(){
            unset($_SESSION['actualizar']);
            $this -> redirect('admin');
        }
    }

?>