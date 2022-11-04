<nav class="main-menu">
    <ul>
        <li>
            <a href="<?php echo constant('URL');?>main">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                    Inicio
                </span>
            </a>
        </li>
        <li class="has-subnav">
            <a href="<?php echo constant('URL');?>perfil">
                <i class="fa fa-user fa-2x"></i>
                <span class="nav-text">
                    Perfil
                </span>
            </a>
        </li>
        <li>
            <a href="<?php echo constant('URL');?>acciones">
                <i class="fa fa-font fa-2x"></i>
                <span class="nav-text">
                    Transacciones 
                </span>
            </a>
        </li>
        <li>
            <a href="<?php echo constant('URL');?>consulta">
                <i class="fa fa-sack-dollar fa-2x"></i>
                <span class="nav-text">
                    Consulta
                </span>
            </a>
        </li>
        <li>
            <a href="<?php echo constant('URL');?>ayuda">
                <i class="fa fa-headset fa-2x"></i>
                <span class="nav-text">
                    Ayuda
                </span>
            </a>
        </li>
    </ul>
    <ul class="logout">
        <li>
           <a href="<?php echo constant('URL');?>login/logout">
                 <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                    Logout
                </span>
            </a>
        </li>  
    </ul>
</nav>