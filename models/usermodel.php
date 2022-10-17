<?php
    class UserModel extends Model implements IModel {

        private $id;
        private $name;
        private $edad;
        private $fena;
        private $curp;
        private $img_client;
        private $domicilio;
        private $codPostal;
        private $municipio;
        private $pais;
        private $tel;
        private $email;
        private $pass;
        private $num_client;
        private $role;
        private $estado;

        function __construct(){
            parent::__construct();

            $this -> name       = ''; 
            $this -> edad       = ''; 
            $this -> fena       = ''; 
            $this -> curp       = ''; 
            $this -> img_client = ''; 
            $this -> domicilio  = ''; 
            $this -> codPostal  = ''; 
            $this -> estado     = ''; 
            $this -> municipio  = ''; 
            $this -> pais       = ''; 
            $this -> tel        = ''; 
            $this -> email      = ''; 
            $this -> pass       = ''; 
            $this -> num_client = ''; 
            $this -> role = '';
            
        }

        public function save(){
            try {
                $query = $this -> prepare('INSERT INTO users(name, edad, fena, curp, img_client, domicilio, codPostal, estado, municipio, pais, tel, email, pass, num_client, role) VALUES (:name, :edad, :fena, :curp, :img_client, :domicilio, :codPostal, :estado, :municipio, :pais, :tel, :email, :pass, :num_client, :role)');
                $query -> execute([
                    'name'       => $this -> name,
                    'edad'       => $this -> edad,
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
                    $item -> setimg_client($p['img_client']);
                    $item -> setDomicilio($p['domicilio']);
                    $item -> setCodPostal($p['codPostal']);
                    $item -> setEstado($p['estado']);
                    $item -> setmunicipio($p['municipio']);
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
                $this -> setimg_client($user['img_client']);
                $this -> setDomicilio($user['domicilio']);
                $this -> setEstado($user['estado']);
                $this -> setmunicipio($user['municipio']);
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
                $query = $this->prepare('UPDATE users SET name = :name, edad = :edad, fena = :fena, curp = :curp, img_client = :img_client, domicilio = :domicilio, codPostal = :codPostal, estado = :estado, municipio = :municipio, pais = :pais, tel = :tel, email = :email, pass = :pass, :role = :role  WHERE id = :id');
                $query->execute([ 'id' => $this -> id]);
                    
                $query -> execute([
                    'name'       => $this -> name,
                    'edad'       => $this -> edad,
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
                    'pass'       => $this -> pass,
                    'role'       => $this -> role
                ]);

                return true;

            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }
        
        function getUsers($id){
            try{
                $query = $this->prepare('SELECT * FROM users WHERE id = :id');
                $query->execute(['id' => $id]);
                
                if($query->rowCount() == 1){
                    $item = $query->fetch(PDO::FETCH_ASSOC); 
                    $user = $this -> from($item);

                    return $user;
                }
            }catch(PDOException $e){
                return NULL;
            }
        }

        public function from($array){
            $this -> id         = $array['id'];
            $this -> name       = $array['name'];
            $this -> edad       = $array['edad'];
            $this -> fena       = $array['fena'];
            $this -> curp       = $array['curp'];
            $this -> img_client  = $array['img_client'];
            $this -> domicilio  = $array['domicilio'];
            $this -> codPostal  = $array['codPostal'];
            $this -> estado     = $array['estado'];
            $this -> municipio  = $array['municipio'];
            $this -> pais       = $array['pais'];
            $this -> tel        = $array['tel'];
            $this -> email      = $array['email'];
            $this -> pass       = $array['pass'];
            $this -> num_client = $array['num_client']; 
            $this -> role       = $array['role']; 
        }

        public function exists($email){
            try{
                $query = $this->prepare('SELECT email FROM users WHERE email = :email');
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
                $user = $this -> get($userid);
                
                return password_verify($pass, $user->getPass());
            }catch(PDOException $e){
                return NULL;
            }
        }

        function escape($value){
            $return = '';
            for($i = 0; $i < strlen($value); ++$i) {
                $char = $value[$i];
                $ord = ord($char);

                if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
                    $return .= $char;
                else
                    $return .= '\\x' . dechex($ord);
            }

            return $return;
        }

        function busqueda($busqueda, $id){
            $q = $this -> escape($busqueda);
            $this -> getUsers($id);
            $num_client = $this -> getNum_Client();
            $id_client = $num_client[0];
            
            try {
                $query = $this -> prepare("SELECT * FROM users WHERE num_client LIKE '%". $id_client ."%' AND name LIKE '%". $q ."%'");
                $query -> execute();

                $results = $query -> fetchAll(PDO::FETCH_OBJ);

                if (is_countable($results) > 0) {
                    $i = 1;
                    $data = '<thead>
                                <tr>
                                    <td>#</td>
                                    <td class="celdas">Usuario</td>
                                    <td class="celdas">num_client</td>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($results as $cliente){

                        if($cliente -> num_client !== $num_client)
                        $data .=
                                '<tr>
                                    <td>'. $i         .'</td>
                                    <td>'. $cliente -> name       .'</td>
                                    <td>'. $cliente -> num_client .'</td>
                                </tr>';
                        $i++;
                    }
                    return $data;
                } 
                
                if (empty($results)) {
                    return "<tr><td><td>No se encontraron coincidencias con sus criterios de búsqueda!</td></tr>";
                }
            } catch (PDOException $e){
                echo $e;
            }
        }

        function tableUsers($id){
            $this -> getUsers($id);
            $num_client = $this -> getNum_Client();
            $id_client = $num_client[0];
            
            try {
                $query = $this -> prepare("SELECT * FROM users WHERE num_client LIKE '%" . $id_client ."%' ORDER BY id");
                $query -> execute();

                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                
                if (is_countable($results) > 0) {
                    $data = '<thead>
                                <tr>
                                    <td>#</td>
                                    <td class="celdas">Usuario</td>
                                    <td class="celdas">num_client</td>
                                </tr>
                            </thead>
                            <tbody>';
                    $i = 1;
                    foreach($results as $user){

                        if($user -> num_client !== $num_client)
                        $data .=
                                '<tr>
                                    <td>'. $i         .'</td>
                                    <td>'. $user -> name       .'</td>
                                    <td>'. $user -> num_client .'</td>
                                </tr>';
                        $i++;
                    }
                    
                    return $data;
                } 
                
                if (empty($results)) {
                    return "<tr><td><td>No se encontraron coincidencias con sus criterios de búsqueda!</td></tr>";
                }
            } catch (PDOException $e){
                echo $e;
            }
        }


        public function setId($id){                 $this -> id         = $id;         }
        public function setName($name){             $this -> name       = $name;       }
        public function setEdad($edad){             $this -> edad       = $edad;       }
        public function setFena($fena){             $this -> fena       = $fena;       }
        public function setCurp($curp){             $this -> curp       = $curp;       }
        public function setimg_client($img_client){   
            $directorio = "/var/www/JadarBank/public/img/";

            $archivo =  $directorio . basename($img_client["name"]);
            
            if(move_uploaded_file($img_client["tmp_name"], $archivo)){
                $this -> img_client = $img_client['name'];
            }
        }
        public function setDomicilio($domicilio){   $this -> domicilio  = $domicilio;  }
        public function setCodPostal($codPostal){   $this -> codPostal  = $codPostal;  }
        public function setEstado($estado){         $this -> estado     = $estado;     }
        public function setmunicipio($municipio){   $this -> municipio  = $municipio;  }
        public function setPais($pais){             $this -> pais       = $pais;       }
        public function setTel($tel){               $this -> tel        = $tel;        }
        public function setEmail($email){           $this -> email      = $email;      }
        public function setNum_client($id){ 
            $num_executive = $this -> getNumExecutive($id);

            try {
                $query = $this -> db -> connect() -> prepare('SELECT * FROM users ORDER by id DESC LIMIT 1');
                $query -> execute(); 
                $id = $query -> fetch(PDO::FETCH_ASSOC);

            } catch (PDOException $e){
                echo $e;
            }

            $num_client = $num_executive[0] . 'C' . $id['id'] + 1;

            $this -> num_client = $num_client; 
        }
        public function setRole($role){             $this -> role       = $role;       }
        public function setPass($pass){
            $this -> pass = password_hash($pass, PASSWORD_BCRYPT);
        }
        
        public function getId(){         return $this -> id         ;}
        public function getName(){       return $this -> name       ;}
        public function getEdad(){       return $this -> edad       ;}
        public function getFena(){       return $this -> fena       ;}
        public function getCurp(){       return $this -> curp       ;}
        public function getimg_client(){ return $this -> img_client ;}
        public function getDomicilio(){  return $this -> domicilio  ;}
        public function getCodPostal(){  return $this -> codPostal  ;}
        public function getEstado(){     return $this -> estado     ;}
        public function getmunicipio(){  return $this -> municipio  ;}
        public function getPais(){       return $this -> pais       ;}
        public function getTel(){        return $this -> tel        ;}
        public function getEmail(){      return $this -> email      ;}
        public function getPass(){       return $this -> pass       ;}
        public function getNum_client(){ return $this -> num_client ;}
        public function getRole(){       return $this -> role       ;}

        public function getNumExecutive($id){
            $query = $this -> prepare('SELECT * FROM users WHERE id = :id');
            $query -> execute([$id]); 

            $results = $query -> fetch(PDO::FETCH_ASSOC);

            if (is_countable($results) > 0) {
                return $results['num_client'];
            }
        }
    }
?>