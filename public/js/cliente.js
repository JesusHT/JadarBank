const Cant  = document.getElementById("cant");
const Saldo = document.getElementById("saldo").value;

Cant.addEventListener("change", () => {
    let cantidad = parseInt(Cant.value, 10); 

    if (cantidad <= Saldo) {
        Cant.classList.remove('error');
    } else {
        Cant.classList.add('error');
    }    
    
});
