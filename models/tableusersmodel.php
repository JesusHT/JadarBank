<?php

    class TableUsersModel extends Model {
        private $paginaActual;
        private $totalPaginas;
        private $nResultados;
        private $resultadosPorPagina;
        private $indice;

        function __construct(){
            parent::__construct();

            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $this->resultadosPorPagina = 10;
            $this->indice = 0;
            $this->paginaActual = 1;

            $this -> calcularPaginas($_SESSION['user']);
        }

        function calcularPaginas($id){
            $query = new UserModel();
            $num_client = $query -> getNumExecutive($id);
            $id_client = $num_client[0];

            $query = $this -> prepare("SELECT COUNT(*) AS total FROM cliente WHERE num_client LIKE '". $id_client ."%'");
            $query -> execute();

            $this->nResultados = $query->fetch(PDO::FETCH_OBJ)->total; 
            $this->totalPaginas = round($this->nResultados / $this->resultadosPorPagina);

            if(isset($_GET['pagina'])){
                if(!is_numeric($_GET['pagina'])){
                    $redirect = new Controller();
                    $redirect -> redirect('admin', ['error' => Errors::ERROR_ADMIN_TABLEUSERS_FAILED]);

                    return NULL;
                }

                $this->paginaActual = $_GET['pagina'];
                $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
            }
        }

        function mostrarPaginas(){
            $actual = '';
            $data = "<ul>";
    
            for($i=1; $i <= $this->totalPaginas; $i++){
                
                if($i == $this->paginaActual){
                    $actual = ' class="actual" ';
                }

                $data .= '<li><a ' .$actual . 'href="?pagina='. $i . '">'. $i . '</a></li>';
                
                $actual = '';
            }

            $data .= "</ul>";

            return $data;
        }

        function escape($string){
            $res = '';
            for($i = 0; $i < strlen($string); ++$i) {
                $char = $string[$i];
                $ord = ord($char);

                if($char !== "'" && $char !== "\"" && $char !== '\\' && $ord >= 32 && $ord <= 126)
                    $res .= $char;
                else
                    $res .= '\\x' . dechex($ord);
            }

            return $res;
        }

        function getTableUsers($busqueda, $id){
            $error = '<p class="bg-Info">No se encontraro ningun cliente</p><br>';
            $query = new UserModel();
            $num_client = $query -> getNumExecutive($id);
            $id_client = $num_client[0];
            
            $sql = "SELECT * FROM cliente WHERE num_client LIKE '" . $id_client ."%' AND status = 'activo' ORDER BY id LIMIT :pos, :n";

            if ($busqueda !== NULL) {
                $error = '<p class="bg-Error">No se encontraron coincidencias con sus criterios de búsqueda</p><br>';
                $q = $this -> escape($busqueda);
                $sql = "SELECT * FROM cliente WHERE num_client LIKE '". $id_client ."%' AND name LIKE '%". $q ."%' AND status = 'activo' LIMIT :pos, :n";
            }
            
            try {
                $query = $this -> prepare($sql);
                $query -> execute(['pos' => $this->indice, 'n' => $this->resultadosPorPagina]);

                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                $data = '';
                
                if (count($results) > 0) {  
                    $i = $this -> indice;

                    if ($this -> indice == 0) {$i = $this -> indice + 1;}
                    foreach($results as $user){

                        if($user -> num_client !== $num_client)
                        $data .=
                                '<tr>
                                    <td>'. $i         .'</td>
                                    <td>'. $user -> name       .'</td>
                                    <td class="text-center">'. $user -> num_client .'</td>
                                    <td>                                            
                                        <button type="button" class="btn" onclick="openModal('.$user -> id.')"><i class="fa-solid fa-trash-can"></i></button>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'editar" method="POST">
                                            <input type="hidden" name="actualizar" value="'.  $user -> id .'">
                                            <button type="submit" class="btn"><i class="fa-solid fa-pencil"></i></button>	
                                        </form>
                                    </td>
                                    <td>
                                        <form action="'. constant('URL') .'ver" method="POST">
                                            <input type="hidden" id="" name="ver" value="'.  $user -> id .'">
                                            <button type="submit" class="btn"><i class="fa-solid fa-eye"></i></button>	
                                        </form>
                                    </td>
                                </tr>';
                        $i++;
                    }
                    
                    return $data;
                } 
                
                return $error;
                

            } catch (PDOException $e){
                echo $e;
            }
        }
    }


?>