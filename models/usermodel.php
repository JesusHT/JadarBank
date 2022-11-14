<?php
    class UserModel extends Model implements IModel {

        private $id;
        private $name;
        private $fena;
        private $curp;
        private $img_client;
        private $domicilio;
        private $codPostal;
        private $estado;
        private $ciudad;
        private $pais;
        private $tel;
        private $email;
        private $pass;
        private $num_client;
        private $role;
        private $status;
        private $codigobanco;
        private $codigosucursal;
        private $digitodecontrol;
        private $num_cuenta;
        private $cuentaClave;

        function __construct(){
            parent::__construct();

            $this -> name            = ''; 
            $this -> fena            = ''; 
            $this -> curp            = ''; 
            $this -> img_client      = ''; 
            $this -> domicilio       = ''; 
            $this -> codPostal       = ''; 
            $this -> estado          = ''; 
            $this -> ciudad          = ''; 
            $this -> pais            = ''; 
            $this -> tel             = ''; 
            $this -> email           = ''; 
            $this -> pass            = ''; 
            $this -> num_client      = ''; 
            $this -> role            = '';
            $this -> status          = '';
            $this -> codigobanco     = 111;
            $this -> codigosucursal  = '001';
            $this -> digitodecontrol = '';
            $this -> num_cuenta      = '';
            $this -> cuentaClave     = '';
        }

        public function save(){
            try {
                $query = $this -> prepare('INSERT INTO cliente (name, fena, curp, img_client, domicilio, codPostal, estado, ciudad, pais, tel, email, pass, num_client, role, status) VALUES (:name, :fena, :curp, :img_client, :domicilio, :codPostal, :estado, :ciudad, :pais, :tel, :email, :pass, :num_client, :role, :status)');
                $query -> execute([
                    'name'       => $this -> name,
                    'fena'       => $this -> fena,
                    'curp'       => $this -> curp,
                    'img_client' => $this -> img_client,
                    'domicilio'  => $this -> domicilio,
                    'codPostal'  => $this -> codPostal,
                    'estado'     => $this -> estado,
                    'ciudad'     => $this -> ciudad,
                    'pais'       => $this -> pais,
                    'tel'        => $this -> tel,
                    'email'      => $this -> email,
                    'pass'       => $this -> pass,
                    'num_client' => $this -> num_client,
                    'role'       => $this -> role,
                    'status'     => $this -> status
                ]);

                return true;
            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        public function createAccount(){
            $this -> createNumAccount();

            try {
                $query = $this -> prepare('INSERT INTO cuenta (num_client, num_cuenta, saldo, credito) VALUES (:num_client, :num_cuenta, :saldo, :credito)');
                $query -> execute([
                    'num_client' => $this -> num_client,
                    'num_cuenta' => $this -> cuentaClave,
                    'saldo'      => 0,
                    'credito'    => 2000
                ]);
                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        public function createNumAccount(){
            $this -> digitodecontrol = $this -> num_client[2];

            for ($i=1; $i <= 11; $i++) { 
                $this -> num_cuenta .= rand(0,9);
            }

            $this -> cuentaClave = $this -> codigobanco . $this -> codigosucursal . $this -> num_cuenta . $this -> digitodecontrol;

        }
        
        public function get($id, $tabla){
            $sql = $tabla ? 'SELECT * FROM ejecutivo WHERE id = :id' : 'SELECT * FROM cliente WHERE id = :id';

            try {
                $query = $this->prepare($sql);
                $query->execute([ 'id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);

                return $user;

            } catch (PDOException $e) {
                echo $e;
            }
        }

        public function delete($id){
            try{
                $status = "inactivo";
                $query = $this->prepare('UPDATE cliente SET status = :status WHERE id = :id');
                $query -> execute([ 'id' => $id, 'status' => $status]);

                return true;

            } catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function update($id){
            try {
                $query = $this->prepare('UPDATE cliente SET name = :name, fena = :fena, curp = :curp, img_client = :img_client, domicilio = :domicilio, codPostal = :codPostal, estado = :estado, municipio = :municipio, pais = :pais, tel = :tel, email = :email, pass = :pass  WHERE id = :id');
                $query->execute([ 'id' => $this -> id]);
                    
                $query -> execute([
                    'name'       => $this -> name,
                    'fena'       => $this -> fena,
                    'curp'       => $this -> curp,
                    'img_client' => $this -> img_client,
                    'domicilio'  => $this -> domicilio,
                    'codPostal'  => $this -> codPostal,
                    'estado'     => $this -> estado,
                    'municipio'  => $this -> municipio,
                    'pais'       => $this -> pais,
                    'tel'        => $this -> tel,
                    'email'      => $this -> email,
                    'pass'       => $this -> pass
                ]);

                return true;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        
        function getUsers($id){
            try{
                $query = $this -> prepare('SELECT * FROM cliente WHERE id = :id');
                $query->execute(['id' => $id]);
                
                if($query->rowCount() == 1){
                    $item = $query -> fetch(PDO::FETCH_ASSOC); 
                    $user = $this  -> from($item);

                    return $user;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function from($array){
            $this -> id         = $array['id'];
            $this -> name       = $array['name'];
            $this -> fena       = $array['fena'];
            $this -> curp       = $array['curp'];
            $this -> img_client = $array['img_client'];
            $this -> domicilio  = $array['domicilio'];
            $this -> codPostal  = $array['codPostal'];
            $this -> estado     = $array['estado'];
            $this -> ciudad     = $array['ciudad'];
            $this -> pais       = $array['pais'];
            $this -> tel        = $array['tel'];
            $this -> email      = $array['email'];
            $this -> pass       = $array['pass'];
            $this -> role       = $array['role']; 
            $this -> status     = $array['status']; 
            $this -> num_client = $array['role'] === 'admin' ? $array['num_empleado'] : $array['num_client'];
        }

        public function exists($email){
            try{
                $query = $this -> prepare('SELECT email FROM cliente WHERE email = :email');
                $query->execute(['email' => $email]);
                
                if($query->rowCount() > 0){
                    return true;
                }
                
                return false;
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        function comparePasswords($pass, $userid){
            try{
                $user = $this -> get($userid,TRUE);
                
                return password_verify($pass, $user['pass']);
            }catch(PDOException $e){
                return NULL;
            }
        } 

        function createPass(){
            $newpass = "";
			$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
			$max = strlen($pattern)-1;
		    for($i = 0; $i < 10; $i++){ 
		    	$newpass .= substr($pattern, mt_rand(0,$max), 1);
		    }

            return $newpass;
        }

        // Establecer el valor de las variables 
        public function setimg_client($img_client){   
            $archivo = constant('URL-IMG') . basename($img_client["name"]);
            
            if(move_uploaded_file($img_client["tmp_name"], $archivo)){
                $this -> img_client = $img_client['name'];
                return true;
            }

            return false;
            
        }
        
        public function setNum_client(){ 
            $num_executive = $this -> getNumExecutive();

            try {
                $query = $this -> prepare('SELECT * FROM cliente ORDER by id DESC LIMIT 1');
                $query -> execute(); 
                $id = $query -> fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                echo $e;
            }

            $num_client = $num_executive[0] . 'C' . $id['id'] + 1;

            $this -> num_client = $num_client;
        }
        
        public function setPass($pass){             $this -> pass       = password_hash($pass, PASSWORD_BCRYPT);}
        public function setId($id){                 $this -> id         = $id;         }
        public function setName($name){             $this -> name       = $name;       }
        public function setFena($fena){             $this -> fena       = $fena;       }
        public function setCurp($curp){             $this -> curp       = $curp;       }
        public function setDomicilio($domicilio){   $this -> domicilio  = $domicilio;  }
        public function setCodPostal($codPostal){   $this -> codPostal  = $codPostal;  }
        public function setEstado($estado){         $this -> estado     = $estado;     }
        public function setCiudad($ciudad){         $this -> ciudad     = $ciudad;     }
        public function setPais($pais){             $this -> pais       = $pais;       }
        public function setTel($tel){               $this -> tel        = $tel;        }
        public function setEmail($email){           $this -> email      = $email;      }
        public function setRole($role){             $this -> role       = $role;       }
        public function setStatus($status){         $this -> status     = $status;     }
        
        // Obtener el valor de las variables
        public function getId(){         return $this -> id         ;}
        public function getName(){       return $this -> name       ;}
        public function getFena(){       return $this -> fena       ;}
        public function getCurp(){       return $this -> curp       ;}
        public function getimg_client(){ return $this -> img_client ;}
        public function getDomicilio(){  return $this -> domicilio  ;}
        public function getCodPostal(){  return $this -> codPostal  ;}
        public function getEstado(){     return $this -> estado     ;}
        public function getCiudad(){     return $this -> ciudad     ;}
        public function getPais(){       return $this -> pais       ;}
        public function getTel(){        return $this -> tel        ;}
        public function getEmail(){      return $this -> email      ;}
        public function getPass(){       return $this -> pass       ;}
        public function getNum_client(){ return $this -> num_client ;}
        public function getRole(){       return $this -> role       ;}
        public function getStatus(){     return $this -> status     ;}
        public function getNumExecutive(){
            $query = $this -> prepare('SELECT * FROM ejecutivo WHERE id = :id');
            $query -> execute(['id' => $_SESSION['user']]); 

            $results = $query -> fetch(PDO::FETCH_ASSOC);

            if (is_countable($results) > 0) {
                return $results['num_empleado'];
            }
        }
        public function getImg($id){
            try {
                $query = $this -> prepare('SELECT img_client FROM cliente WHERE id = :id');
                $query -> execute(['id' => $id]); 
                $img_client = $query -> fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                echo $e;
            }
            
            return $img_client;
        }
    }
?>