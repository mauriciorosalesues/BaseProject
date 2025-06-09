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


    <title>Create Post</title>
</head>

<body>
     <!--Reutilizar y adaptar el navbar-->
    <nav class="main-header navbar navbar-expand border-bottom navbar-dark" style="margin: 0; padding: 0;">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" style="color: white">CRUD Clientes</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cogs" style="color: white"></i>
                    <span class="hidden-xs" style="color: white"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="{{ route('clientes.index') }}"  class="dropdown-item">
                        <i class="fas fa-reply"></i> Volver
                    </a>
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                        document.getElementById('frm-logout').submit();" class="dropdown-item"> <i class="fas fa-sign-out-alt"></i></i></i> Cerrar Sesión</a>

                    <form id="frm-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>

        </ul>
    </nav>

    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Add a Post</h3>
                <form method="post" action="{{ route('clientes.store') }}" id="formulario" >
                    @csrf
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label for="selector">
                            <span>Selecciona el tipo de cliente:</span>
                            </label>
                            <select id="tipo" name="tipo">
                            <option value=""></option>
                            <option value="Nuevo">Nuevo</option>
                            <option value="Frecuente">Frecuente</option>
                            <option value="Preferencial">Preferencial</option>
                            </select>
                    </div>                   
                    <br>
                    @canany(['create','store'])                    
                    <button type="submit"  class="btn btn-primary">Create Post</button>                    
                    <a href="{{ route('clientes.index') }}">Cancelar</a>
                    @endcan
                </form>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div id="mensajeError" style="color: red; margin-top: 10px;"></div>
            </div>
        </div>
    </div>
    <!--Llamada a las validaciones js -->
    <script src={{ asset('js/cliente.js') }}></script>
</body>

</html>