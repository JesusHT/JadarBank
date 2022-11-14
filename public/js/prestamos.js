const cantidad = document.getElementById('cantidad');
const plazo    = document.getElementById('plazo');
const table    = document.getElementById('tabla');
const error    = document.getElementById('span-error');

cantidad.addEventListener('change', function(){
    let value = cantidad.value;

    if (value > 99 && value <= 1000000) {
        let count;
        let n;
        cantidad.classList.remove('danger');

        if (value >= 1000 && value <= 10000) {
            n = 1;
            count = 18;
        } else if (value >= 10001 && value <= 100000) {
            n = 12;
            count = 60;
        } else if (value >= 100001){
            n = 36;
            count = 60;
        } else {
            n = 1;
            count = 3;
        } 
        let html = ``;
        for (let i = n; i <= count; i++) {
            html += `<option value="`+ (i) +`">`+ (i) +` mes</option>`; 
        }

        error.innerHTML = '';
        plazo.innerHTML = html;
    } else {
        error.innerHTML = 'La cantidad minima es 100 pesos y la cantidad maxima 1,000,000 pesos';
        plazo.innerHTML = '<option value="" selected hidden>Elija un plazo en meses.</option>';
        cantidad.classList.add('danger');
    }
});