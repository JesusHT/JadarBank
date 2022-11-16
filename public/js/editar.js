const Pais   = document.getElementById('Pais');
const Estado = document.getElementById('Estado');
const Ciudad = document.getElementById('ciudad');
const Form   = document.getElementById('formUpdate');
const submit = document.getElementById('submit');

var pais           = new Array();
var estado         = new Array();
var ciudad         = new Array();
var positionPais   = 0;
var positionEstado = 0;

setPaises();

Pais.addEventListener("change", function(){
    setEstados(Pais.value);
});

Estado.addEventListener("change", function(){
    setCiudades(Estado.value);
});

function setPaises(){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        let html = '<option value="'+ Pais.value +'" selected hidden>'+ Pais.value +'</option>';

        for (let i = 0; i < data.length; i++) {
            html += `<option value="` + data[i].pais + `">` + data[i].pais + `</option>`;     
            pais[i] = data[i].pais;
        }

        Pais.innerHTML = html;
    });
}

function setEstados(select){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        positionPais = pais.indexOf(select);
         
        let html = '';

        for (let i = 0; i < data[positionPais].estados.length; i++) {
            html += `<option value="` + data[positionPais].estados[i].nombre + `">` + data[positionPais].estados[i].nombre + `</option>`; 
            estado[i] = data[positionPais].estados[i].nombre;
        }

        Estado.innerHTML = html;
    });
}

function setCiudades(select){
    fetch('./../../public/json/paises.json')
    .then(response => response.json())
    .then(function(data){
        positionEstado = estado.indexOf(select);

        let html = '';

        for (let i = 0; i < data[positionPais].estados[positionEstado].ciudades.length; i++) {
            html += `<option value="` + data[positionPais].estados[positionEstado].ciudades[i].nombre + `">` + data[positionPais].estados[positionEstado].ciudades[i].nombre + `</option>`; 
        }
        
        Ciudad.innerHTML = html;
    });
}
