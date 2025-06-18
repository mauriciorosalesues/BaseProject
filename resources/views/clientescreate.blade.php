<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('images/logo.png') }}" rel="icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
    <!-- Theme style -->
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <!-- Mensajes Toast -->
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/adminlte.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Libreria alertas -->


    <title>Añadir Cliente</title>

  
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Agregar cliente</h3>
                <form method="post" action="{{ route('clientes.store') }}" id="formulario" >
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" >
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" >
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" >
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo de Cliente:</label>
                        <select id="tipo" name="tipo" class="form-control">
                            <option value=""></option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Frecuente" >Frecuente</option>
                            <option value="Preferencial" >Preferencial</option>
                        </select>
                    </div>                   
                    <br>
                    @canany(['create','store'])                    
                    <button type="submit"  class="btn btn-primary">Create Post</button>                    
                    <a href="{{ route('clientes.index') }}">Cancelar</a>
                    @endcan
                </form>
            </div>
        </div>
    </div>
    <!--Llamada a las validaciones js -->
    <script src={{ asset('js/cliente.js') }}></script>
    <script>
    // Función para guardar datos del formulario en LocalStorage
    function guardarFormularioCliente() {
        const cliente = {
            name: document.getElementById('name').value,
            telefono: document.getElementById('telefono').value,
            correo: document.getElementById('correo').value,
            direccion: document.getElementById('direccion').value,
            tipo: document.getElementById('tipo').value
        };
        localStorage.setItem('formularioCliente', JSON.stringify(cliente));
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Recuperar datos si existen
        const datos = JSON.parse(localStorage.getItem('formularioCliente'));
        if (datos) {
            document.getElementById('name').value = datos.name || '';
            document.getElementById('telefono').value = datos.telefono || '';
            document.getElementById('correo').value = datos.correo || '';
            document.getElementById('direccion').value = datos.direccion || '';
            document.getElementById('tipo').value = datos.tipo || '';
        }

        // Guardar cada vez que se escriba en los campos
        ['name', 'telefono', 'correo', 'direccion', 'tipo'].forEach(id => {
            document.getElementById(id).addEventListener('input', guardarFormularioCliente);
        });

        // Limpiar el LocalStorage si el formulario se envía correctamente
        document.getElementById('formulario').addEventListener('submit', () => {
            localStorage.removeItem('formularioCliente');
        });
    });

    
</script>
</body>

</html>