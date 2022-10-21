const rute = "http://JadarBank.com/";

let menu = `
<nav class="main-menu">
<ul>
    <li>
        <a href="` + rute +`admin">
            <i class="fa fa-home fa-2x"></i>
            <span class="nav-text">
                Inicio
            </span>
        </a>
    </li>
    <li class="has-subnav">
        <a href="` + rute +`perfil">
            <i class="fa fa-user fa-2x"></i>
            <span class="nav-text">
                Perfil
            </span>
        </a>
    </li>
    <li class="has-subnav">
        <a href="` + rute +`nuevo">
           <i class="fa fa-user-plus fa-2x"></i>
            <span class="nav-text">
                Registro
            </span>
        </a>
    </li>
    <li>
        <a href="` + rute +`transacciones">
            <i class="fa fa-font fa-2x"></i>
            <span class="nav-text">
                Transacciones 
            </span>
        </a>
    </li>
    <li>
        <a href="` + rute +`prestamos">
            <i class="fa fa-sack-dollar fa-2x"></i>
            <span class="nav-text">
                Prestamos
            </span>
        </a>
    </li>
    <li>
        <a href="` + rute +`ayuda">
            <i class="fa fa-headset fa-2x"></i>
            <span class="nav-text">
                Ayuda
            </span>
        </a>
    </li>
</ul>

<ul class="logout">
    <li>
       <a href="` + rute +`login/logout">
             <i class="fa fa-power-off fa-2x"></i>
            <span class="nav-text">
                Logout
            </span>
        </a>
    </li>  
</ul>
</nav>
`;

document.getElementById('menu').innerHTML = menu;