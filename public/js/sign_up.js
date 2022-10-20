fetch('./../../public/json/Estados.json')
    .then(response => response.json())
    .then(function(data){
        let html = '<option value="" selected hidden>Seleccione un Estado</option>';
        for (let i = 0; i < data.length; i++) {
            html += `<option value="` + data[i].Estado.replace(/ /g,'') + `">` + data[i].Estado + `</option>`;
        }
        document.getElementById('estado').innerHTML = html;
});

document.getElementById('estado').addEventListener("change", e => {
    let select = "";
    select = document.getElementById("estado").value;
    if (select !== "") {
        fetch('./../../public/json/Municipios.json')
            .then(response => response.json())
            .then(function(datos){
                let municipios = '<option value="" disabled selected>Seleccione un municipio</option>';
                datos[select].forEach(element => {
                    municipios += `<option value="` + element.replace(/ /g,'') + `">` + element + `</option>`;
                });
                document.getElementById('municipio').innerHTML = municipios; 
        })
    }
});