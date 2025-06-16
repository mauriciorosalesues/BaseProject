//Validaciones
document.addEventListener("DOMContentLoaded", function () { //carga el script cuando la pagina este carga
    const formulario = document.getElementById('formulario');

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
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El campo nombre no puede estar vacío.",                
            });
            return;
        }
        
        if (!/^\d+$/.test(telefono.trim())) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El teléfono solo debe contener números.",                
            });
            return;
        }
        if (telefono.trim().length !== 8 ) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El teléfono debe tener 8 números.",                
            });
            return;
        }

        if (email.trim() === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El campo email no puede estar vacío.",                
            });
            return;
        }

        if (!validarEmail(email)) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "El formato del email no es válido.",                
            });
            return;
        }

        if (direccion.trim() === '') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Debes agregar una direccion.",                
            });
            return;
        }
        if(selector == null || selector == 0){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "ERROR: Debe seleccionar una opcion del combo box",                
            });
            return ;
        }
        
        Swal.fire({
            title: '¿Guardar cliente?',
            text: "Se guardarán los datos ingresados.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Guardado!", "", "success")
                .then(()=>{                    
                formulario.submit(); // Enviar si el usuario confirma
                // realiza el submit si pasa todas las validaciones
                });
            } else if (result.isDenied) {
                Swal.fire("El cliente no se registro!", "", "info");
            }
        });
        

    });

    function validarEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});