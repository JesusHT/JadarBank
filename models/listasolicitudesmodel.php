<?php

    class ListaSolicitudesModel extends Model {
        private $list;
        private $massege;

        function __construct(){
            parent::__construct();    

            $this -> list    = '';
            $this -> massege = '<p class="Messeges-Info mb-2 mt-2">No hay solicitudes disponibles.</p>';
        }

        function getListRequests(){
            try {
                $query = $this -> prepare("SELECT * FROM cliente WHERE status = 'pendiente'");
                $query -> execute();
                $customers = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($customers) > 0) {
                    foreach($customers as $cutomer){
                        $this -> list .= '
                            <div class="card">
                                <div class="banner">
                                    <div class="avatar">
                                        <img src="'. constant('URL') .'public/img/'. $cutomer -> img_client .'" alt="Foto del cliente" title="Foto del cliente">
                                    </div>
                                </div>
                                <h3>'.$cutomer -> name.'</h3>
                                <p><span>CURP:</span> '.$cutomer -> curp.'</p>
                                <p><span>Fecha de nacimiento:</span> '.$cutomer -> fena.'</p>
                                <form action="'. constant('URL') .'solicitud/aceptado" method="POST">
                                    <input type="hidden" name="aceptar" value="'.$cutomer -> id.'">
                                    <button type="submit" class="btn mb-1 mt-1 btn-solicitud bg-success btn-solicitud-success">Aceptar</button>
                                </form>
                                <form action="'. constant('URL') .'solicitud/rechazado" method="POST">
                                    <input type="hidden" name="rechazar" value="'.$cutomer -> id.'">
                                    <button type="submit" class="btn mb-1 mt-1 btn-solicitud bg-error btn-solicitud-error">Rechazar</button>
                                </form>
                            </div>
                        ';
                    }

                    return $this -> list;
                }

                return $this -> massege;

            } catch (PDOException $e) {
                echo $e;
                return NULL;
            }
        }
    }
?>