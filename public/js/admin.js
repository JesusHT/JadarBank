const borrar = document.getElementById("eliminar");
const modal  = document.getElementById("myModal");
const span   = document.getElementById("num_client");

function openModal(id, num_client){
    modal.style.display = "block";
    borrar.value = id;
    span.innerHTML = num_client;
}

function closedModal(){
    modal.style.display = "none";
    span.innerHTML = '';
}