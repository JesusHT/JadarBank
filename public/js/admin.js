var borrar = document.getElementById("eliminar");
var modal  = document.getElementById("myModal");

function openModal(id){
    modal.style.display = "block";
    borrar.value = id;
    console.log(id);
}

function closedModal(){
    modal.style.display = "none";
}