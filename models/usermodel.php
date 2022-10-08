<?php
    class UserModel extends Model implements IModel {

        private $id;
        private $name;
        private $edad;
        private $fena;
        private $curp;
        private $img_cliet;
        private $domicilio;
        private $codPostal;
        private $muncipio;
        private $pais;
        private $tel;
        private $email;
        private $pass;
        private $num_client;
        private $role;

        function __construct(){
            parent::__construct();

            $this -> name       = ''; 
            $this -> edad       = ''; 
            $this -> fena       = ''; 
            $this -> curp       = ''; 
            $this -> img_cliet  = ''; 
            $this -> domicilio  = ''; 
            $this -> codPostal  = ''; 
            $this -> muncipio   = ''; 
            $this -> pais       = ''; 
            $this -> tel        = ''; 
            $this -> email      = ''; 
            $this -> pass       = ''; 
            $this -> num_client = ''; 
            $this -> role = '';
            
        }

        public function save(){
            try {
                $query = $this -> prepare('INSERT INTO users(name, edad, fena, curp, img_client, domicilio, codPostal, municipio, pais, tel, email, pass, num_client, role) VALUES (:name, :edad, :fena, :curp, :img_client, :domicilio, :codPostal, :municipio, :pais, :tel, :email, :pass, :num_client, :role)');
                $query -> execute([
                    'name'       => $this -> name,
                    'edad'       => $this -> edad,
                    'fena'       => $this -> fena,
                    'curp'       => $this -> curp,
                    'img_client' => $this -> img_cliet,
                    'domicilio'  => $this -> domicilio,
                    'codPostal'  => $this -> codPostal,
                    'municipio'  => $this -> muncipio,
                    'pais'       => $this -> pais,
                    'tel'        => $this -> tel,
                    'email'      => $this -> email,
                    'pass'       => $this -> pass,
                    'num_client' => $this -> num_client,
                    'role'       => $this -> role
                ]);
                return true;
            } catch (PDOException $e){
                echo $e;
                return false;
            }
        }

        public function getAll(){
            $items = [];

            try {
                $query = $this -> query('SELECT * FROM clinets');
                while ($p = $query ->fetch(PDO::FETCH_ASSOC)) {
                    $item = new UserModel();
                    
                    $item -> setId($p['id']);
                    $item -> setName($p['name']);
                    $item -> setEdad($p['edad']);
                    $item -> setFena($p['fena']);
                    $item -> setCurp($p['curp']);
                    $item -> setImg_cliet($p['img_client']);
                    $item -> setDomicilio($p['domicilio']);
                    $item -> setCodPostal($p['codPostal']);
                    $item -> setMuncipio($p['municipio']);
                    $item -> setPais($p['pais']);
                    $item -> setTel($p['tel']);
                    $item -> setEmail($p['email']);
                    $item -> setPass($p['pass'], false);
                    $item -> setNum_client($p['num_client']);
                    $item -> setRole($p['role']);
                    
                    array_push($items, $item);
                }
                return $items;

            } catch (PDOException $e) {
                echo $e;
            }
        }
        
        public function get($id){
            try {
                $query = $this->prepare('SELECT * FROM users WHERE id = :id');
                $query->execute([ 'id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);
                      
                $this -> setId($user['id']);
                $this -> setName($user['name']);
                $this -> setEdad($user['edad']);
                $this -> setCurp($user['curp']);
                $this -> setFena($user['fena']);
                $this -> setImg_cliet($user['img_client']);
                $this -> setDomicilio($user['domicilio']);
                $this -> setMuncipio($user['municipio']);
                $this -> setCodPostal($user['codPostal']);
                $this -> setTel($user['tel']);
                $this -> setPais($user['pais']);
                $this -> setEmail($user['email']);
                $this -> setPass($user['pass'], false);
                $this -> setNum_client($user['num_client']);
                $this -> setRole($user['role']);

                return $this;

            } catch (PDOException $e) {
                echo $e;
            }
        }

        public function delete($id){
            try{
                $query = $this->prepare('DELETE FROM users WHERE id = :id');
                $query->execute([ 'id' => $id]);

                return true;

            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function update(){
            try {
                $query = $this->prepare('UPDATE users SET name = :name, edad = :edad, fena = :fena, curp = :curp, img_client = :img_client, domicilio = :domicilio, codPostal = :codPostal, municipio = :municipio, pais = :pais, tel = :tel, email = :email, pass = :pass, :role = :role  WHERE id = :id');
                $query->execute([ 'id' => $this -> id]);
                    
                $query -> execute([
                    'name'       => $this -> name,
                    'edad'       => $this -> edad,
                    'fena'       => $this -> fena,
                    'curp'       => $this -> curp,
                    'img_client' => $this -> img_cliet,
                    'domicilio'  => $this -> domicilio,
                    'codPostal'  => $this -> codPostal,
                    'municipio'  => $this -> muncipio,
                    'pais'       => $this -> pais,
                    'tel'        => $this -> tel,
                    'email'      => $this -> email,
                    'pass'       => $this -> pass,
                    'role'       => $this -> role
                ]);

                return true;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        public function from($array){
            $this -> id         = $array['id'];
            $this -> name       = $array['name'];
            $this -> edad       = $array['edad'];
            $this -> fena       = $array['fena'];
            $this -> curp       = $array['curp'];
            $this -> img_cliet  = $array['img_client'];
            $this -> domicilio  = $array['domicilio'];
            $this -> codPostal  = $array['codPostal'];
            $this -> muncipio   = $array['muncipio'];
            $this -> pais       = $array['pais'];
            $this -> tel        = $array['tel'];
            $this -> email      = $array['email'];
            $this -> pass       = $array['pass'];
            $this -> num_client = $array['num_client']; 
            $this -> role = $array['role']; 
        }

        public function exists($email){
            try{
                $query = $this->prepare('SELECT email FROM users WHERE email = :email');
                $query->execute( ['email' => $email]);
                
                if($query->rowCount() > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        function comparePasswords($pass, $userid){
            try{
                $user = $this -> get($userid);
                
                return password_verify($pass, $user->getPass());
            }catch(PDOException $e){
                return NULL;
            }
        }

        private function getHashedPassword($pass){
            return password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
        }
        
        public function setPass($pass, $hash = true){
            if($hash){
                $this->password = $this->getHashedPassword($pass);
            }else{
                $this->password = $pass;
            }
        }

        public function setId($id){                 $this -> id         = $id;         }
        public function setName($name){             $this -> name       = $name;       }
        public function setEdad($edad){             $this -> edad       = $edad;       }
        public function setFena($fena){             $this -> fena       = $fena;       }
        public function setCurp($curp){             $this -> curp       = $curp;       }
        public function setImg_cliet($img_cliet){   $this -> img_cliet  = $img_cliet;  }
        public function setDomicilio($domicilio){   $this -> domicilio  = $domicilio;  }
        public function setCodPostal($codPostal){   $this -> codPostal  = $codPostal;  }
        public function setMuncipio($muncipio){     $this -> muncipio   = $muncipio;   }
        public function setPais($pais){             $this -> pais       = $pais;       }
        public function setTel($tel){               $this -> tel        = $tel;        }
        public function setEmail($email){           $this -> email      = $email;      }
        public function setNum_client($num_client){ $this -> num_client = $num_client; }
        public function setRole($role){             $this -> role       = $role;       }
        
        public function getId(){         return $this -> id         ;}
        public function getName(){       return $this -> name       ;}
        public function getEdad(){       return $this -> edad       ;}
        public function getFena(){       return $this -> fena       ;}
        public function getCurp(){       return $this -> curp       ;}
        public function getImg_cliet(){  return $this -> img_cliet  ;}
        public function getDomicilio(){  return $this -> domicilio  ;}
        public function getCodPostal(){  return $this -> codPostal  ;}
        public function getMuncipio(){   return $this -> muncipio   ;}
        public function getPais(){       return $this -> pais       ;}
        public function getTel(){        return $this -> tel        ;}
        public function getEmail(){      return $this -> email      ;}
        public function getPass(){       return $this -> pass       ;}
        public function getNum_client(){ return $this -> num_client ;}
        public function getRole(){       return $this -> role       ;}
    }
?>