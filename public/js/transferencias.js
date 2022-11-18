const btnNuevo   = document.getElementById('btn-nuevo');
const Nuevo      = document.getElementById('nuevo');
const Guardar    = document.getElementById('guardar');
const Guardados  = document.getElementById('guardados');
const Alias      = document.getElementById('alias');
const Clave      = document.getElementById('clabeInterbancaria');
const Importe    = document.getElementById('Importe');
const btnImporte = document.getElementById('btn-importe');
const Motivo     = document.getElementById('Motivo');
const Return     = document.getElementById('return');

btnNuevo.addEventListener('click',()=>{
    Nuevo.classList.add('activo');
    btnNuevo.classList.add('inactivo');
})

Guardar.addEventListener('click',()=>{
    let data = '<input type="radio" name="opciones" id="1" value="'+ Clave.value +'" selected><lavel for="1">'+ Alias.value +'</lavel>';

    Guardados.innerHTML = data;
    Nuevo.classList.remove('activo');
    Importe.classList.add('activo');
})

Return.addEventListener('click', () => {
    Nuevo.classList.remove('activo');
    btnNuevo.classList.remove('inactivo');
})

btnImporte.addEventListener('click',()=>{
    btnImporte.classList.add('inactivo')
    Motivo.classList.add('activo');
})


