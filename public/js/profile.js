const element               = document.getElementById('switch');
const element2              = document.getElementById('switch2');
const Edit                  = document.getElementById('edit');
const EditContent           = document.getElementById('edit-content');
const Configuracion         = document.getElementById('configuracion');
const ConfiguracionContent  = document.getElementById('configuracion-content');
const notifications         = document.getElementById('notifications');
const notificationsContent  = document.getElementById('notifications-content');

element.addEventListener('click', () => {
    active(element);
});

element2.addEventListener('click', () => {
    active(element2);
});

Configuracion.addEventListener('click', ()=> {
    
    addClass(Configuracion,'activo')
    addClass(ConfiguracionContent,'active')
    
    removeClass(Edit,'activo')
    removeClass(EditContent,'active')

    removeClass(notifications,'activo')
    removeClass(notificationsContent, 'active')
})

Edit.addEventListener('click', () => {
    
    addClass(Edit,'activo')
    addClass(EditContent,'active')

    removeClass(notifications,'activo')
    removeClass(notificationsContent, 'active')

    removeClass(Configuracion,'activo')
    removeClass(ConfiguracionContent,'active')

})

notifications.addEventListener('click', () => {
    addClass(notifications,'activo')
    addClass(notificationsContent, 'active')

    removeClass(Edit,'activo')
    removeClass(EditContent,'active')

    removeClass(Configuracion,'activo')
    removeClass(ConfiguracionContent,'active')
})

function active(elemento){
    
    if (parseInt(elemento.value,10)) {
        elemento.value = "0";
    } else {
        elemento.value = "1";
    }
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