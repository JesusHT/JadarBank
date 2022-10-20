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
        private $municipio;
        private $pais;
        private $tel;
        private $email;
        private $pass;
        private $num_client;
        private $role;
        private $status;

        function __construct(){
            parent::__construct();

            $this -> name       = ''; 
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
            $this -> role       = '';
            $this -> status     = '';
        }

        public function save(){
            try {
                $query = $this -> prepare('INSERT INTO users (name, fena, curp, img_client, domicilio, codPostal, estado, municipio, pais, tel, email, pass, num_client, role) VALUES (:name, :fena, :curp, :img_client, :domicilio, :codPostal, :estado, :municipio, :pais, :tel, :email, :pass, :num_client, :role)');
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
                $status = "inactivo";
                $query = $this->prepare('UPDATE users SET status = :status WHERE id = :id');
                $query -> execute([ 'id' => $id, 'status' => $status]);

                return true;

            }catch(PDOException $e){
                echo $e;
                return false;
            }
        }

        public function update(){
            try {
                $query = $this->prepare('UPDATE users SET name = :name, fena = :fena, curp = :curp, img_client = :img_client, domicilio = :domicilio, codPostal = :codPostal, estado = :estado, municipio = :municipio, pais = :pais, tel = :tel, email = :email, pass = :pass  WHERE id = :id');
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
                $query = $this -> prepare('SELECT * FROM users WHERE id = :id');
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
            $this -> municipio  = $array['municipio'];
            $this -> pais       = $array['pais'];
            $this -> tel        = $array['tel'];
            $this -> email      = $array['email'];
            $this -> pass       = $array['pass'];
            $this -> num_client = $array['num_client']; 
            $this -> role       = $array['role']; 
            $this -> status     = $array['status']; 
        }

        public function exists($email){
            try{
                $query = $this -> prepare('SELECT email FROM users WHERE email = :email');
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
                                    <td class="celdas">Num_client</td>
                                    <td class="celdas">Eliminar</td>
                                    <td class="celdas">Editar</td>
                                    <td class="celdas">ver</td>
                                </tr>
                            </thead>
                            <tbody>';
                    foreach($results as $cliente){

                        if($cliente -> num_client !== $num_client)
                        $data .=
                                '<tr>
                                    <td>'. $i                     .'</td>
                                    <td>'. $cliente -> name       .'</td>
                                    <td>'. $cliente -> num_client .'</td>
                                    <td>
                                        <form action="'. constant('URL') .'admin/delete" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-trash-can"></i></button>	
                                        </form>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'admin/update" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-pencil"></i></button>	
                                        </form>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'admin/view" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-eye"></i></button>	
                                        </form>
                                    </td>
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
                                    <td class="celdas">Nombre</td>
                                    <td class="celdas">numero_cliente</td>
                                    <td class="celdas">Eliminar</td>
                                    <td class="celdas">Editar</td>
                                    <td class="celdas">ver</td>
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
                                    <td>
                                        <form action="'. constant('URL') .'admin/delete" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-trash-can"></i></button>	
                                        </form>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'admin/update" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-pencil"></i></button>	
                                        </form>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'admin/ver" method="POST">
                                            <input type="hidden" name="eliminar-user" value="'.  $cliente -> id .'">
                                            <button type="submit"><i class="fa-solid fa-eye"></i></button>	
                                        </form>
                                    </td>
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

        // Establecer el valor de las variables 
        public function setimg_client($img_client){   
            $directorio = "/var/www/JadarBank/public/img/";

            $archivo =  $directorio . basename($img_client["name"]);
            
            if(move_uploaded_file($img_client["tmp_name"], $archivo)){
                $this -> img_client = $img_client['name'];
            }
        }
        
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
        
        public function setPass($pass){             $this -> pass       = password_hash($pass, PASSWORD_BCRYPT);}
        public function setId($id){                 $this -> id         = $id;         }
        public function setName($name){             $this -> name       = $name;       }
        public function setEdad($edad){             $this -> edad       = $edad;       }
        public function setCurp($curp){             $this -> curp       = $curp;       }
        public function setDomicilio($domicilio){   $this -> domicilio  = $domicilio;  }
        public function setCodPostal($codPostal){   $this -> codPostal  = $codPostal;  }
        public function setEstado($estado){         $this -> estado     = $estado;     }
        public function setmunicipio($municipio){   $this -> municipio  = $municipio;  }
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
        public function getmunicipio(){  return $this -> municipio  ;}
        public function getPais(){       return $this -> pais       ;}
        public function getTel(){        return $this -> tel        ;}
        public function getEmail(){      return $this -> email      ;}
        public function getPass(){       return $this -> pass       ;}
        public function getNum_client(){ return $this -> num_client ;}
        public function getRole(){       return $this -> role       ;}
        public function getStatus(){     return $this -> status     ;}
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