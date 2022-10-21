<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/nav.css">
</head>
<body>
    <nav class="main-menu">
            <ul>
                <li>
                    <a href="<?php echo constant('URL');?>admin">
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
                <li class="has-subnav">
                    <a href="<?php echo constant('URL');?>nuevo">
                       <i class="fa fa-user-plus fa-2x"></i>
                        <span class="nav-text">
                            Registro
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo constant('URL');?>transacciones">
                        <i class="fa fa-font fa-2x"></i>
                        <span class="nav-text">
                            Transacciones 
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo constant('URL');?>prestamos">
                        <i class="fa fa-sack-dollar fa-2x"></i>
                        <span class="nav-text">
                            Prestamos
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
</body>
</html>