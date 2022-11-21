<?php

    class Perfil extends Controller {
        
        private $cliente;
        private $config;

        function __construct(){
            parent::__construct();
            $this -> redirectRole();
            $query = new UserModel();
            
            if ($_SESSION['role'] !== 'admin') {
                $this -> perfilCliente($query);
            } else {
                $this -> cliente = $query -> get($_SESSION['user'],TRUE);
                $this -> view -> render('perfil/index', ['client' => $this -> cliente]);
            }
        }

        function perfilCliente($query){
                $this -> cliente = $query -> get($_SESSION['user'],NULL);
                $query -> getUsers($_SESSION['user']);
                $config = new CuentasModel();
                
                $this -> config = $config -> queryConfiguration($query -> getNum_client());
                
                $this -> view -> render('perfil/index', [
                    'client' => $this -> cliente,
                    'config' => $this -> config
                ]);
        }
    }

?>