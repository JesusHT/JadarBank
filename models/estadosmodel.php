<?php

    class EstadosModel extends Model {
        private $customer;

        private $transferencias;
        private $retiros;
        private $movimientos;

        function __construct($id){
            parent::__construct();

            $this -> customer = new CustomersModel();
            $this -> customer -> queryCustomer($id);
            $this -> customer -> queryAccountForNumClient($this -> customer -> getNum_client());

            $this -> transferencias = 0;
            $this -> retiros        = 0;
        }

        function getData(){
            $this -> queryMovimientos();

            $data = [
                'name'           => $this -> customer -> getName(),
                'codPostal'      => $this -> customer -> getCodPostal(),
                'domicilio'      => $this -> customer -> getDomicilio(),
                'estado'         => $this -> customer -> getEstado(),
                'num_cuenta'     => $this -> customer -> getNum_cuenta(),
                'num_client'     => $this -> customer -> getNum_client(),
                'saldo'          => $this -> decimales($this -> customer -> getSaldo()),
                'transferencias' => $this -> decimales($this -> transferencias),
                'retiros'        => $this -> decimales($this -> retiros),
                'movimientos'    => $this -> movimientos
            ];

            return $data;
        }

        function queryMovimientos(){
            try {
                $query = $this -> prepare('SELECT * FROM movimientos WHERE num_client = :num_client ORDER BY id DESC');
                $query -> execute(["num_client" => $this -> customer -> getNum_client()]);
                $movimientos = $query -> fetchAll(PDO::FETCH_OBJ);

                if (count($movimientos) > 0) {  
                    foreach ($movimientos as $movimiento) {
                        if ($movimiento -> cargo == 'retiro') {
                            $this -> retiros += $movimiento -> cant; 
                        } 

                        if ($movimiento -> cargo == 'transferencia') {
                            $this -> transferencias += $movimiento -> cant; 
                        }

                        $this -> movimientos .= '<tr>
                                                    <td>'. $movimiento -> fecha .'</td>
                                                    <td>'. $movimiento -> cargo .'</td>';

                        if ($movimiento -> cargo == 'retiro') {
                            $this -> movimientos .= '<td>$'. $this -> decimales($movimiento -> cant) .'</td>
                                                     <td>$0.00</td>
                                                     <td>$0.00</td>';
                        }

                        if ($movimiento -> cargo == 'transferencia') {
                            $this -> movimientos .= '<td>$0.00</td>
                                                     <td>$'. $this -> decimales($movimiento -> cant) .'</td>
                                                     <td>$0.00</td>';
                        } 

                        if ($movimiento -> cargo == 'presatamo' ||
                            $movimiento -> cargo == 'pago'      ||
                            $movimiento -> cargo == 'recibido'  ||
                            $movimiento -> cargo == 'otro'
                        ) {
                            $this -> movimientos .= '<td>$0.00</td>
                                                     <td>$0.00</td>
                                                     <td>$'. $this -> decimales($movimiento -> cant) .'</td>';
                        }

                        $this -> movimientos .= '<td>$'. $this -> decimales($movimiento -> saldo) .'</td></tr>';
                    }
                }

                return false;
            } catch (PDOException $e) {
                echo $e;
                return false;
            }
        }

        function decimales($value){return number_format($value, 2, '.', '');}
    }

?>