<?php

    class Templates {

        public function styles(){
            $syles = '
                    <style>
                        *{
                            margin: auto;
                            padding: auto;
                        }
                        p {
                            font-weight: bold;
                        }
                    </style>
            ';

            return $syles;
        }

        public function newUser($nombre){
            $data = '
                        <div>
                            <p>Hola ' . $nombre .' !</p>
                            <P>Bienvenido a Jadar Bank es un gusto tenerte con nostros</P>
                        </div>
                    ';

            return $this -> styles() . $data;
        }
    }


?>

