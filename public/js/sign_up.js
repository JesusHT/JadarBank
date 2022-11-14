const Pais      = document.getElementById('pais');
const Estado    = document.getElementById('estado');
const Ciudad    = document.getElementById('ciudad');
const Datos     = document.getElementById('datos');
const Domicilio = document.getElementById('domicilio');
const Contacto  = document.getElementById('contacto');
const Li2       = document.getElementById('2');
const Li3       = document.getElementById('3');
const Next      = document.getElementById('next');
const Previus   = document.getElementById('previous');
const Submit    = document.getElementById('submit');

var pais           = new Array();
var estado         = new Array();
var ciudad         = new Array();
var positionPais   = 0;
var positionEstado = 0;

getPaises();

Pais.addEventListener("change", function(){
    getEstados(Pais.value);
});

Estado.addEventListener("change", function(){
    getCiudades(Estado.value);
});

function getPaises(){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        let html = '<option value="" selected hidden>Seleccione un Pais</option>';

        for (let i = 0; i < data.length; i++) {
            html += `<option value="` + data[i].pais + `">` + data[i].pais + `</option>`;     
            pais[i] = data[i].pais;
        }

        Pais.innerHTML = html;
    });
}

function getEstados(select){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        positionPais = pais.indexOf(select);
         
        let html = '<option value="" selected hidden>Seleccione un Estado</option>';

        for (let i = 0; i < data[positionPais].estados.length; i++) {
            html += `<option value="` + data[positionPais].estados[i].nombre + `">` + data[positionPais].estados[i].nombre + `</option>`; 
            estado[i] = data[positionPais].estados[i].nombre;
        }

        Estado.innerHTML = html;
    });
}

function getCiudades(select){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        positionEstado = estado.indexOf(select);

        let html = '<option value="" selected hidden>Seleccione una ciudad</option>';

        for (let i = 0; i < data[positionPais].estados[positionEstado].ciudades.length; i++) {
            html += `<option value="` + data[positionPais].estados[positionEstado].ciudades[i].nombre + `">` + data[positionPais].estados[positionEstado].ciudades[i].nombre + `</option>`; 
        }
        
        Ciudad.innerHTML = html;
    });
}

function classExist(clase){
    let exist = clase.classList;

    if (exist[0] !== 'active') {
        return false;
    }

    return true;
}

Next.addEventListener('click',() =>{

    if (classExist(Li2) && classExist(Li3) === false) {
        Domicilio.style.display = "none";
        Contacto.style.display = "block";
        Next.style.display = "none";
        Li3.classList.add('active');
        Submit.style.display = "block";
    } else {
        Datos.style.display = "none";
        Domicilio.style.display = "block";
        Li2.classList.add('active');
        Previus.style.display = 'inline-block';
    }
});

Previus.addEventListener('click',() =>{

    if (classExist(Li2) && classExist(Li3)) {
        Contacto.style.display = "none";
        Domicilio.style.display = "block";
        Li3.classList.remove('active');
        Next.style.display = "inline-block";
        Submit.style.display = "none";
    } else {
        Datos.style.display = "block";
        Domicilio.style.display = "none";
        Previus.style.display = 'none';
        Li2.classList.remove('active');
    }
});