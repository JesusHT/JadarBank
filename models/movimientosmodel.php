<?php
    class MovimientosModel extends Model {
        private $movimientos;
        private $cargo;
        private $fecha;
        private $descripcion;
        private $monto;
        private $saldo;
        private $num_client;

        function __construct(){
            parent::__construct();

            $this -> fecha = date('y-m-d');
            $this -> movimientos = ['retiro', 'transferencia', 'presatamo', 'pago','recibido','depositos','otro'];
        }

        function generarMovimiento(){
            try {
                $query = $this -> prepare('INSERT INTO movimientos (num_client, cargo, descripcion, cant, fecha, saldo) VALUES (:num_client, :cargo, :descripcion, :cant, :fecha, :saldo)');
                $query -> execute([
                    'num_client'  => $this -> num_client,
                    'cargo'       => $this -> cargo,
                    'descripcion' => $this -> descripcion,
                    'cant'        => $this -> monto,
                    'fecha'       => $this -> fecha,
                    'saldo'       => $this -> saldo
                ]);

                return true;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function querySaldo(){
            try {
                $query = $this -> prepare('SELECT saldo FROM cuenta WHERE num_client = :num_client');
                $query -> execute(['num_client'=> $this -> num_client]);

                if($query->rowCount() == 1){
                    $account = $query -> fetch(PDO::FETCH_ASSOC); 

                    return $account['saldo'];
                }
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function queryMovimientos($num_client){
            try {
                $query = $this -> prepare('SELECT * FROM movimientos WHERE num_client = :num_client ORDER BY id DESC');
                $query -> execute(['num_client'=> $num_client]);
                
                $movimientos = $query -> fetchAll(PDO::FETCH_OBJ);
                $data = '<table>
                            <thead>
                                <tr>
                                    <td>Información</td>
                                    <td class="text-center">Cantidad</td>
                                </tr>
                            </thead>
                            <tbody>';

                if (count($movimientos) > 0) {
                    foreach($movimientos as $movimiento){
                        $data .= '<tr>
                                    <td class="informacion">
                                        <p class="cargo">'      . $movimiento -> cargo       . ' - '. $movimiento -> fecha .'</p>
                                        <p>Descripción: '. $movimiento -> descripcion .'</p>
                                    </td>';

                        if ($movimiento -> cargo == "presatamo" || $movimiento -> cargo == 'recibido' || $movimiento -> cargo == 'depositos') {
                            $data .= '<td class="cant"><p><span class="mas"><i class="fa-solid fa-plus-large"></i></span>$'. $movimiento -> cant   . '</p></td></tr>';
                        } else {
                            $data .= '<td class="cant"><p><span class="menos"><i class="fa-solid fa-hyphen"></i></span>$'. $movimiento -> cant . '</p></td></tr>';
                        }
                    }
                    
                    $data .= '</tbody></table>';

                    return $data;
                }

                return '<p class="bg-lightblue data">No hay movimientos aún.</p>';
                
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function setNum_client ($num_client ){ $this -> num_client  = $num_client                             ;}
        function setCargo      ($accion     ){ $this -> cargo       = $this -> movimientos[$accion]           ;}
        function setDescripcion($descripcion){ $this -> descripcion = $descripcion                            ;}
        function setMonto      ($monto      ){ $this -> monto       = $monto                                  ;}
        function setSaldo      (            ){ $this -> saldo       = $this -> querySaldo($this -> num_client);}
    }

?>