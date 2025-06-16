document.addEventListener("DOMContentLoaded", function () { //carga el script cuando la pagina este carga
    const formulario = document.getElementById('formulario');
    const mensajeError = document.getElementById('mensajeError');

    formulario.addEventListener('submit', function (evento) {
        evento.preventDefault(); // previene el envío del formulario para poder validarlo con Javascript
        //campos a validar
        let nombre = document.getElementById('nombre').value;
        let password = document.getElementById('password').value;


        //validación de los campos
        if (nombre.trim() === '') {
            mensajeError.innerText = 'El campo nombre no puede estar vacío.';
            return;
        }
        if (password.trim()==''){
            mensajeError.innerText = 'El campo contraseña no puede estar vacío.';
            return;
        }        
        

        mensajeError.innerText = '';
        formulario.submit(); // realiza el submit si pasa todas las validaciones
    });
    
});