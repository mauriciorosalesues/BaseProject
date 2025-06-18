<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>CRUDPosts</title>
    <link href="{{ asset('images/logo_0.png') }}" rel="icon">
     <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome iconos -->
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Toastr (mensajes tipo toast) -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

    <!-- Estilo de botones -->
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">

    <!-- jQuery y Bootstrap JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('content-admin-css')
</head>

<body>
    
    <style>
    table{
        height: 300px;
        width: 600px;
    }
</style>
<div class="container">
    <h2 class="text-center">Clientes</h2> 
    <table class="table table-striped table-dark text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Correo</th>
                <th scope="col">Dirección</th>
                <th scope="col">Cliente</th>
                @canany(['create','store','delete','edit'])
                    <th scope="col">Acciones</th>
                @endcanany
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente['id'] }}</td>
                    <td>{{ $cliente['name'] }}</td>
                    <td>{{ $cliente['telefono'] }}</td>
                    <td>{{ $cliente['correo'] }}</td>
                    <td>{{ $cliente['direccion'] }}</td>
                    <td>{{ $cliente['tipo'] }}</td>
                    @canany(['create','store','delete','edit'])
                    <td>

                        <a href="{{ route('clientes.edit', $cliente->id) }}"
                            style="font-weight: bold; background-color: #f0ad4e; color: white !important; width: 100px; height: 38px; display: inline-flex; justify-content: center; align-items: center; border-radius: 20px;"
                            class="btn btn-warning">
                            Editar
                        </a>

                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                data-id="{{ $cliente->id }}"
                                onclick="confirmarEliminacion(this)"
                                style="font-weight: bold; background-color: #ff4351; color: white !important; width: 100px; height: 38px; display: inline-flex; justify-content: center; align-items: center; border-radius: 20px;"
                                class="btn btn-danger">
                                Eliminar
                            </button>

                        </form>

                    </td>
                    @endcanany
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>


<script>
    function confirmarEliminacion(boton) {
        const id = boton.getAttribute("data-id");
        Swal.fire({
            title: `¿Estás seguro de eliminar el registro con Id: ${id} ?`,// muestra el id a eliminar
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("El Registro ha sido eliminado! ", "", "success")
                .then(()=>{                    
                boton.closest('form').submit(); // Buscar el formulario más cercano y enviarlo
                });
            }
        });
    }
</script>

</html>

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

