const cantidad     = document.getElementById('cantidad');
const plazo        = document.getElementById('plazo');
const table        = document.getElementById('tabla');

cantidad.addEventListener('change', function(){
    let value = cantidad.value;

    if (value > 99) {
        cantidad.classList.remove('danger');

        if (value >= 100 && value <= 10000) {
            count = 12;
        } else if (value >= 10001) {
            count = 60;
        } else {  
            count = 3;
        } 
        let html = ``;
        for (let i = 0; i < count; i++) {
            html += `<option value="`+ (i+1) +`">`+ (i+1) +` mes</option>`; 
        }

        plazo.innerHTML = html;
    } else {
        cantidad.classList.add('danger');
    }
});