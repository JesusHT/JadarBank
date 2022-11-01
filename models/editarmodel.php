<?php

    class EditarModel extends Model {

        private $name      ;    
        private $fena      ;    
        private $curp      ;    
        private $pais      ;    
        private $codPostal ;    
        private $estado    ;    
        private $ciudad    ;    
        private $domicilio ;  
        private $img_client;

        function __construct(){
            parent::__construct();

            $this -> name       = '';
            $this -> fena       = '';
            $this -> curp       = '';
            $this -> pais       = '';
            $this -> codPostal  = '';
            $this -> estado     = '';
            $this -> ciudad     = '';
            $this -> domicilio  = '';
            $this -> img_client = '';            
        }

        public function update($id){
            try {
                $query = $this->prepare('UPDATE cliente SET name = :name, fena = :fena, curp = :curp, img_client = :img_client, domicilio = :domicilio, codPostal = :codPostal, estado = :estado, ciudad = :ciudad, pais = :pais WHERE id = :id');
                $query -> execute([
                    'id'         => $id,
                    'name'       => $this -> name,
                    'fena'       => $this -> fena,
                    'curp'       => $this -> curp,
                    'img_client' => $this -> img_client,
                    'domicilio'  => $this -> domicilio,
                    'codPostal'  => $this -> codPostal,
                    'estado'     => $this -> estado,
                    'ciudad'     => $this -> ciudad,
                    'pais'       => $this -> pais
                ]);

                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        public function setName      ($name      ){ $this -> name       = $name      ;}
        public function setFena      ($fena      ){ $this -> fena       = $fena      ;}
        public function setCurp      ($curp      ){ $this -> curp       = $curp      ;}
        public function setPais      ($pais      ){ $this -> pais       = $pais      ;}
        public function setCodPostal ($codPostal ){ $this -> codPostal  = $codPostal ;}
        public function setEstado    ($estado    ){ $this -> estado     = $estado    ;}
        public function setCiudad    ($ciudad    ){ $this -> ciudad     = $ciudad    ;}
        public function setDomicilio ($domicilio ){ $this -> domicilio  = $domicilio ;}
        public function setImg_client($img_client){ $this -> img_client = $img_client;}
    }


?>