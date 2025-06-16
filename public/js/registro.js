document.addEventListener("DOMContentLoaded", function () { //carga el script cuando la pagina este carga
    const formulario = document.getElementById('formulario');

    formulario.addEventListener('submit', function (evento) {
        evento.preventDefault(); // previene el envío del formulario para poder validarlo con Javascript
        //campos a validar
        let nombre = document.getElementById('nombre').value;
        let password = document.getElementById('password').value;


        //validación de los campos
        if (nombre.trim() === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El campo nombre no puede estar vacío.",                
            });
            return;
        }
        if (password.trim()==''){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El campo contraseña no puede estar vacío",                
            });
            return;
        }        
        
        Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Usuario Creado",
        showConfirmButton: false,
        timer: 1500
        });
        sessionStorage.setItem("mostrarAlerta", "true"); // Marca para la siguiente vista
        formulario.submit(); // realiza el submit si pasa todas las validaciones
    });
    
});