const btnNuevo   = document.getElementById('btn-nuevo');
const btnImporte = document.getElementById('btn-importe');
const btnSelect  = document.getElementById('btn-select');

const Nuevo      = document.getElementById('nuevo');
const Guardar    = document.getElementById('guardar');
const Guardados  = document.getElementById('guardados');
const Alias      = document.getElementById('alias');
const Clave      = document.getElementById('clabeInterbancaria');
const Importe    = document.getElementById('Importe');
const Motivo     = document.getElementById('Motivo');
const Return     = document.getElementById('return');
const Cant       = document.getElementById("cantidad");
const Saldo      = document.getElementById("saldo").value;
var   radios     = document.querySelectorAll('div.guardados > input');

Cant.addEventListener("change", () => {
    let cantidad = parseInt(Cant.value, 10); 

    if (cantidad <= Saldo && cantidad != 0 && cantidad < 250001) {
        Cant.classList.remove('error');
        btnImporte.disabled = false;
    } else {
        btnImporte.disabled = true;
        Cant.classList.add('error');
    } 
});

Clave.addEventListener("change", () => {
    if (Clave.value != '' && Alias.value != '' && Clave.value > 0) {
        Guardar.disabled = false;
    } else {
        Guardar.disabled = true;
    }
});

Alias.addEventListener("change", () => {
    if (Clave.value != '' && Alias.value != '' && Clave.value > 0) {
        Guardar.disabled = false;
    } else {
        Guardar.disabled = true;
    }
});

btnNuevo.addEventListener('click',()=>{
    Nuevo.classList.add('activo');
    Guardados.classList.add('inactivo');
    btnNuevo.classList.add('inactivo');
});

btnSelect.addEventListener('click', ()=> {
    btnNuevo.classList.add('inactivo');
    radios.forEach(element => {
        if (element.checked !== true) {
            document.getElementById(element.id).classList.add('disable');
        }
    });
    btnSelect.classList.add('inactivo');
    Importe.classList.add('activo');
});

radios.forEach(element => {
    document.getElementById(element.id).addEventListener('change', () =>{
        if (element.checked) {
            btnSelect.disabled = false;
        }
    })
});


Guardar.addEventListener('click', () =>{
    Guardados.classList.remove('inactivo');
    radios.forEach(element => {
        if (element.checked !== true) {
            document.getElementById(element.id).classList.add('disable');
        }
    });
    btnSelect.classList.add('inactivo');
    
    let data = '<input type="radio" name="opciones" id="radio1" value="'+ Clave.value +'"><label for="radio1">'+ Alias.value +'</label>';

    Guardados.innerHTML += data;
    document.getElementById('radio1').checked = true;
    Nuevo.classList.remove('activo');
    Importe.classList.add('activo');
});

Return.addEventListener('click', () => {
    Nuevo.classList.remove('activo');
    btnNuevo.classList.remove('inactivo');
    Guardados.classList.remove('inactivo');
});

btnImporte.addEventListener('click',()=>{
    btnImporte.classList.add('inactivo')
    Motivo.classList.add('activo');
});
