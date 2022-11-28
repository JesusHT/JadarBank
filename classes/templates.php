<?php

    class Templates {

        public function styles(){
            $syles = '
                    <style>
                    * {
                        margin: 0;
                        padding: 0; }
                      
                      body {
                        background-color: #212121;
                        color: #fff; }
                      
                      .content {
                        display: grid;
                        width: 100%;
                        grid-template-columns: repeat(5, 1fr);
                        grid-area: repeat(4, 1fr);
                        grid-template-areas: "header header header header header" "main main main main main" "main main main main main" "footer footer footer footer footer"; }
                        .content header {
                          grid-area: header;
                          width: 100%;
                          display: flex; }
                          .content header .logo {
                            display: inline-flex;
                            width: 100%;
                            padding: 10px;
                            min-width: 150px;
                            justify-content: center; }
                            .content header .logo img {
                              width: 150px;
                              height: 150px; }
                        .content main {
                          grid-area: main;
                          display: flex;
                          width: 100%;
                          min-height: 300px;
                          justify-content: center; }
                          .content main section {
                            width: 70%;
                            padding: 10px; }
                            .content main section div {
                              margin-top: 10px;
                              width: 100%;
                              display: flex;
                              justify-content: center;
                              align-items: center; }
                              .content main section div p {
                                background-color: #0d4755;
                                padding: 20px; }
                        .content footer {
                          grid-area: footer;
                          display: flex;
                          width: 100%;
                          justify-content: center; }
                          .content footer .aviso {
                            width: 70%;
                            text-align: center;
                            padding-left: 10px; }
                            .content footer .aviso p {
                              font-size: 10px; }
                            .content footer .aviso span {
                              display: block;
                              font-weight: bold;
                              margin-bottom: 10px;
                              margin-top: 10px;
                              color: #c18700; }                      
                    </style>
            ';

            return $syles;
        }

        public function newUser($nombre, $pass){
          $data = $this -> styles();
          $data .='
              <div class="content">
                   <main>
                       <section>
                          <h3>Hola '. $nombre .', bienvenido a JadarBank, nos da mucho gusto tenerte con nosotros este es tu password con el podras entrar a la aplicación web y descubrir un mundo de posibilidades: </h3>
                          <div>
                              <p>'. $pass .'</p>
                          </div>
                       </section>
                   </main>
                   <footer>
                      <div class="aviso">
                          <p><span>Aviso Importante:</span> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Si usted ha recibido esta transmisión por error, notifíquenos inmediatamente en nuestros correo electrónico oficial y borre dicho mensaje y sus anexos en caso de contenerlos. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
                      </div>
                   </footer>
              </div>';
            return $data;
        }

        public function newPass($pass, $nombre){
            $data = $this -> styles();
            $data .='
                <div class="content">
                     <main>
                         <section>
                            <h3>Hola '. $nombre .', esta es tú nueva contraseña temporal puedes cambiarla en el apartado de perfil.</h3>
                            <div>
                                <p>'. $pass .'</p>
                            </div>
                         </section>
                     </main>
                     <footer>
                        <div class="aviso">
                            <p><span>Aviso Importante:</span> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Si usted ha recibido esta transmisión por error, notifíquenos inmediatamente en nuestros correo electrónico oficial y borre dicho mensaje y sus anexos en caso de contenerlos. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
                        </div>
                     </footer>
                </div>';

                return $data;
        }


        public function acceptado($nombre){
          $data = $this -> styles();
          $data .='
              <div class="content">
                   <main>
                       <section>
                          <h3>Hola '. $nombre .', tu solicitud de alta ha sido aprovada entra ya a JadarBank.com para poder disfrutar de tus nuevos beneficios.</h3>
                       </section>
                   </main>
                   <footer>
                      <div class="aviso">
                          <p><span>Aviso Importante:</span> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Si usted ha recibido esta transmisión por error, notifíquenos inmediatamente en nuestros correo electrónico oficial y borre dicho mensaje y sus anexos en caso de contenerlos. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
                      </div>
                   </footer>
              </div>';

              return $data;
      }

        public function movimiento($cant, $nombre, $accion){
          $data = $this -> styles();
          $data .='
              <div class="content">
                   <main>
                       <section>
                          <h3>Hola '. $nombre .', se ha realizado una '. $accion .' por la cantidad de '. $cant .' si no has sido tu ponte en contacto con uno de nuestros ejecutivos y te a tenderemos con gusto.</h3>
                       </section>
                   </main>
                   <footer>
                      <div class="aviso">
                          <p><span>Aviso Importante:</span> Este correo electrónico y/o el material adjunto es para uso exclusivo de la persona a la que expresamente se le ha enviado, el cual contiene información confidencial. Si usted ha recibido esta transmisión por error, notifíquenos inmediatamente en nuestros correo electrónico oficial y borre dicho mensaje y sus anexos en caso de contenerlos. Se hace de su conocimiento por medio de esta nota, que cualquier divulgación, copia, distribución o toma de cualquier acción derivada de la información confiada en esta transmisión, queda estrictamente prohibido. </p>
                      </div>
                   </footer>
              </div>';

              return $data;
      }
    }


?>

