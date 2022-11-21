const cant      = document.getElementById('cantidad');
const credito   = document.getElementById('credito').value;
const response  = document.getElementById('reponse');
const Total     = document.getElementById('total');
const form      = document.getElementById('form-prestamos');

const interes       = 0.075/12;
var   cuotaFija     = 0;
var   radios        = document.querySelectorAll('label > input');

form.addEventListener("keydown", (evento) => {
    if (evento.key == "Enter") {
        evento.preventDefault();
        return false;
    }
});


radios.forEach(element => {
    document.getElementById('label'+element.id).addEventListener('click',()=> {
        Total.innerHTML = '';
        Total.innerHTML = 'En total devuelves: ' + limitDecimals(element.value * setCuotaFija(element.value));
    });
});

cant.addEventListener('change', () => {
    let cantidad = parseInt(cant.value, 10); 
    
    if (cantidad <= credito && cantidad > 0) {
        limpiar();
        Total.innerHTML = '';
        response.style.display = 'grid';
        cant.classList.remove('cant-error');
        calPrestamo();
    } else {
        limpiar();
        Total.innerHTML = '';
        response.style.display = 'none';
        cant.classList.add('cant-error');
    }
});

function calPrestamo(){
    radios.forEach(element => {
        if (element.id == 1) {
            document.getElementById('span' + element.id).innerHTML += element.value + ' mensualdidad de ' + limitDecimals(setCuotaFija(element.value));
        } else {
            document.getElementById('span' + element.id).innerHTML += element.value + ' mensualdidades de ' + limitDecimals(setCuotaFija(element.value));
        }
    });
}

function limpiar(){
    radios.forEach(element => {
        document.getElementById('span' + element.id).innerHTML = '';
    });
}

function setCuotaFija(plazo){
    let cantidad = parseInt(cant.value, 10); 

    return cantidad * ((Math.pow(1+interes,plazo)*interes)/(Math.pow(1+interes,plazo)-1));
}

function limitDecimals(value){
    return value.toFixed(2);
}