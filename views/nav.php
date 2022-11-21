<nav class="menu" id="menu">
    <button class="button-menu"><i class="fa fa-solid fa-bars"></i></button>
    <div class="menu-content" id="menu-content">
        <ul>
          <li>
            <span class="img">
              <a href="<?php echo constant('URL');?>admin">
                <img src="../<?php constant('URL'); ?>public/img/logo.png" alt="JadarBank Logo" title="Logo JadarBank">
              </a>
            </span>
          </li>
          <li>
              <a href="<?php echo constant('URL');?>admin">
                  <i class="fa fa-home fa-2x"></i>
                  <span>
                      Inicio
                  </span>
              </a>
          </li>
          <li class="has-subnav">
              <a href="<?php echo constant('URL');?>perfil">
                  <i class="fa fa-user fa-2x"></i>
                  <span>
                      Perfil
                  </span>
              </a>
          </li>
          <li class="has-subnav">
              <a href="<?php echo constant('URL');?>nuevo">
                 <i class="fa fa-user-plus fa-2x"></i>
                  <span>
                      Registro
                  </span>
              </a>
          </li>
          <li>
              <a href="<?php echo constant('URL');?>transacciones">
                  <i class="fa fa-font fa-2x"></i>
                  <span>
                      Transacciones 
                  </span>
              </a>
          </li>
          <li>
              <a href="<?php echo constant('URL');?>prestamos">
                  <i class="fa fa-sack-dollar fa-2x"></i>
                  <span>
                      Prestamos
                  </span>
              </a>
          </li>
          <li>
                <a href="<?php echo constant('URL');?>solicitud">
                    <i class="fa fa-solid fa-users-medical"></i>
                    <span>
                        Solicitud
                    </span>
                </a>
            </li>
          <li>
              <a href="<?php echo constant('URL');?>ayuda">
                  <i class="fa fa-headset fa-2x"></i>
                  <span>
                      Ayuda
                  </span>
              </a>
          </li>
        </ul>
        <ul class="logout">
          <li>
             <a href="<?php echo constant('URL');?>login/logout">
                  <i class="fa fa-power-off fa-2x"></i> 
                  <span>
                        Cerrar sesión 
                  </span>
              </a>
          </li>  
        </ul>
    </div>
</nav>

<script>
    const menu    = document.getElementById('menu');
    const content = document.getElementById('menu-content');

    calScreen();

    menu.addEventListener('click', () => {
        menu.classList.toggle('menu-activo');
    });

    function calScreen(){
        if (screen.height === 1080) {
            content.style.height = "895px";
        }
    }
</script>