const element               = document.getElementById('switch');
const element2              = document.getElementById('switch2');
const element3              = document.getElementById('switch3');
const element4              = document.getElementById('switch4');
const element5              = document.getElementById('switch5');
const Edit                  = document.getElementById('edit');
const EditContent           = document.getElementById('edit-content');
const Configuracion         = document.getElementById('configuracion');
const ConfiguracionContent  = document.getElementById('configuracion-content');
const notifications         = document.getElementById('notifications');
const notificationsContent  = document.getElementById('notifications-content');
const btnSubmit             = document.getElementById('btn-submit');
const response              = document.getElementById('response');
const newPass               = document.getElementById('newpass');
const newPassConfirm        = document.getElementById('newpassconfirm');
const demo2                 = document.getElementById('demo2');
const demo                  = document.getElementById('demo');
const formNotifications     = document.getElementById('formNotifications');
const FormPassword          = document.getElementById('formPassword');
const FormConfiguracion     = document.getElementById('formConfiguracion');

newPass.addEventListener('input', function() {
    let pass = newPassConfirm.value;
    let passCheck = this.value;

    validate(pass,passCheck);
    
});

newPassConfirm.addEventListener('input', function() {
    let pass = newPass.value;
    let passCheck = this.value;

    validate(pass,passCheck);

});


function validate(pass,passCheck){

    if (pass === passCheck) {
        if (!Boolean(pass) && !Boolean(passCheck)) {
            demo.innerHTML  = '<i class="fa-solid fa-x text-Error"></i><span class="text-Error">  Esta vació.</span>';
            demo2.innerHTML  = '<i class="fa-solid fa-x text-Error"></i><span class="text-Error"> Esta vació.</span>';
        } else {
            demo.innerHTML  = '<i class="fa-solid fa-check text-Success"></i><span class="text-Success"> Las contraseñas coinciden.</span>';
            demo2.innerHTML = '<i class="fa-solid fa-check text-Success"></i><span class="text-Success"> Las contraseñas coinciden.</span>';
        }
    } else {
    	demo.innerHTML  = '<i class="fa-solid fa-x text-Error"></i><span class="text-Error"> Las contraseñas NO coinciden.</span>';
        demo2.innerHTML = '<i class="fa-solid fa-x text-Error"></i><span class="text-Error"> Las contraseñas NO coinciden.</span>';
    }

}

element.addEventListener('click', () => {
    active(element);
});

element2.addEventListener('click', () => {
    active(element2);
});

element3.addEventListener('click', () => {
    active(element3);
});

element4.addEventListener('click', () => {
    active(element4);
});

element5.addEventListener('click', () => {
    active(element5);
});

Configuracion.addEventListener('click', ()=> {
    response.innerHTML = '';
    response.classList.remove('bg-error', 'response');

    addClass(Configuracion,'activo')
    addClass(ConfiguracionContent,'active')
    
    removeClass(Edit,'activo')
    removeClass(EditContent,'active')

    removeClass(notifications,'activo')
    removeClass(notificationsContent, 'active')
})

Edit.addEventListener('click', () => {
    response.innerHTML = '';
    response.classList.remove('bg-error', 'response');
    
    addClass(Edit,'activo')
    addClass(EditContent,'active')

    removeClass(notifications,'activo')
    removeClass(notificationsContent, 'active')

    removeClass(Configuracion,'activo')
    removeClass(ConfiguracionContent,'active')

})

notifications.addEventListener('click', () => {
    response.innerHTML = '';
    response.classList.remove('bg-error', 'response');

    addClass(notifications,'activo')
    addClass(notificationsContent, 'active')

    removeClass(Edit,'activo')
    removeClass(EditContent,'active')

    removeClass(Configuracion,'activo')
    removeClass(ConfiguracionContent,'active')
});

btnSubmit.addEventListener('click', () => {
    
    if (classExist(Configuracion,'activo')) {
        updateConfiguration(FormConfiguracion);
    }

    if (classExist(Edit,'activo')) {
        updateConfiguration(FormPassword);
    }

    if (classExist(notifications,'activo')) {
        updateConfiguration(formNotifications);
    }
});

function active(elemento){
    
    if (+elemento.value == 0) {
        elemento.value = 1;
        addClass(elemento, 'active-check');
    } else {
        removeClass(elemento, 'active-check');
        elemento.value = 0;
    }

    console.log(elemento.value);
}

function removeClass(element, clase){
    if (classExist(element,clase)) {
        element.classList.remove(clase);
    }
}

function addClass(element, clase){
    if (!classExist(element,clase)) {
        element.classList.add(clase);
    }
}

function classExist(element, clase){
    let exist = element.classList;

    if (exist[0] !== clase) {
        return false;
    }

    return true;
}

function updateConfiguration(element){
    let form = new FormData(element);

    fetch('../../classes/app.php',{
        method: "post",
        body: form
    }).then((response) =>{
        element.reset();
        demo.innerHTML = '';
        demo2.innerHTML = '';
        return response.json(); 
    }).then((data) =>{
        if (data[0] == true) {
            removeClass(response,'bg-success');
            response.classList.add('bg-success','response');
        } else {
            removeClass(response,'bg-error');
            response.classList.add('bg-error', 'response');
        }
        response.innerHTML = data[1];
    })
}