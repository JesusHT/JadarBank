<?php
    class TablePrestamosModel extends Model {
        private $paginaActual;
        private $totalPaginas;
        private $nResultados;
        private $resultadosPorPagina;
        private $indice;
        private $num_cliente;

        function __construct(){
            parent::__construct();

            $this -> resultadosPorPagina = 10;
            $this -> indice = 0;
            $this -> paginaActual = 1;

            $query = new UserModel();            
            $query -> getUsers($_SESSION['ver']);
            
            $this -> num_cliente = $query -> getNum_client();
            $this -> calPaginas();
        }

        public function calPaginas(){

            $query = $this -> prepare("SELECT COUNT(*) AS total FROM prestamos WHERE num_client = :num_client");
            $query -> execute(['num_client'=> $this -> num_cliente]);

            $this->nResultados = $query->fetch(PDO::FETCH_OBJ)->total; 
            $this->totalPaginas = round($this->nResultados / $this->resultadosPorPagina);

            if(isset($_GET['pagina'])){
                if(!is_numeric($_GET['pagina'])){
                    $redirect = new Controller();
                    $redirect -> redirect('ver', ['error' => Errors::ERROR_DATA_FORMAT_STRING]);

                    return NULL;
                }

                $this->paginaActual = $_GET['pagina'];
                $this->indice = ($this->paginaActual - 1) * $this->resultadosPorPagina;
            }
        }

        function getPages(){
            $actual = '';
            $data = "<ul>";
    
            for($i=1; $i <= $this -> totalPaginas; $i++){
                
                if($i == $this->paginaActual){
                    $actual = ' class="actual" ';
                }

                $data .= '<li><a ' .$actual . 'href="?pagina='. $i . '">'. $i . '</a></li>';
                
                $actual = '';
            }

            $data .= "</ul>";

            return $data;
        }

        function getTablePrestamos(){
            try {
                $query = $this -> prepare("SELECT * FROM prestamos WHERE num_client = :num_client LIMIT :pos, :n");
                $query -> execute(['num_client' => $this -> num_cliente,'pos' => $this->indice, 'n' => $this->resultadosPorPagina]);
                
                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                $data = ' <table>
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Número de prestamo</td>
                                    <td class="text-center">Monto</td>
                                    <td class="text-center">Interes</td>
                                    <td class="text-center">Plazo</td>
                                    <td class="text-center">Estatus </td>
                                    <td class="text-center">Ver</td>
                                </tr>
                            </thead>
                            <tbody>';
                
                if (count($results) > 0) {  
                    $i = $this -> indice;

                    if ($this -> indice == 0) {$i = $this -> indice + 1;}
                    foreach($results as $prestamo){

                        if($prestamo -> num_client !== $this -> num_ejecutivo)
                        $data .=
                                '<tr>
                                    <td>'. $i                        .'</td>
                                    <td>'. $prestamo -> num_prestamo .'</td>
                                    <td>$'. $prestamo -> monto        .'</td>
                                    <td class="text-center">'. $prestamo -> interes*100  .'%</td>
                                    <td>'. $prestamo -> plazo        .' Meses</td>
                                    <td>'. $prestamo -> status        .'</td>
                                    <td>                                            
                                        <button type="button" class="btn" onclick="openModal('.$prestamo -> id.')"><i class="fa-solid fa-eye"></i></button>
                                    </td>
                                </tr>';
                        $i++;
                    }
                    $data .= '</tbody></table>';

                    return $data;
                } else {
                    return '<p class="Messeges-Info mb-2">El cliente no tiene ningún prestamo.</p>';
                }
            } catch (PDOException $e){
                echo $e;
            }
        }
    }
    

?>