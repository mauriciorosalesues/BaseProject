//Validaciones
document.addEventListener("DOMContentLoaded", function () { //carga el script cuando la pagina este carga
    const formulario = document.getElementById('formulario');
    const mensajeError = document.getElementById('mensajeError');

    formulario.addEventListener('submit', function (evento) {
        evento.preventDefault(); // previene el envío del formulario para poder validarlo con Javascript
        //campos a validar
        let nombre = document.getElementById('name').value;
        let telefono = document.getElementById('telefono').value;        
        let email = document.getElementById('correo').value;
        let direccion = document.getElementById('direccion').value;
        let selector = document.getElementById('tipo').selectedIndex;


        //validación de los campos
        if (nombre.trim() === '') {
            mensajeError.innerText = 'El campo nombre no puede estar vacío.';
            return;
        }
        
        if (!/^\d+$/.test(telefono.trim())) {
            mensajeError.innerText = 'El teléfono solo debe contener números.';
            return;
        }
        if (telefono.trim().length !== 8 ) {
            mensajeError.innerText = 'El teléfono debe tener 8 números.';
            return;
        }

        if (email.trim() === '') {
            mensajeError.innerText = 'El campo email no puede estar vacío.';
            return;
        }

        if (!validarEmail(email)) {
            mensajeError.innerText = 'El formato del email no es válido.';
            return;
        }

        if (direccion.trim() === '') {
            mensajeError.innerText = 'Debes agregar una direccion.';
            return;
        }
        if(selector == null || selector == 0){
            alert('ERROR: Debe seleccionar una opcion del combo box');
            return false;
        }
        
        
        

        mensajeError.innerText = '';
        formulario.submit(); // realiza el submit si pasa todas las validaciones
    });

    function validarEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});
