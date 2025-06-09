<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>CRUDPosts</title>
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

    @yield('content-admin-css')
</head>

<body>
    <!--Reutilizar y adaptar el navbar-->
    <nav class="main-header navbar navbar-expand border-bottom navbar-dark" style="margin: 0; padding: 0;">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a  class="nav-link" style="color: white">CRUD Clientes</a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cogs" style="color: white"></i>
                    <span class="hidden-xs" style="color: white"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    @can('create')                    
                    <a href="{{ route('clientes.create') }}"  class="dropdown-item">
                        <i class="fas fa-plus"></i> Agregar
                    </a>
                    @endcan
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

    <style>
    table{
        height: 300px;
        width: 600px;
    }
</style>
<div class="container">
    <h2>Clientes</h2> 
    <tbody>
        <table class="table-striped table-dark">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">telefono</th>
                    <th scope="col">correo</th>
                    <th scope="col">direccion</th>
                    <th scope="col">Cliente</th>
                </tr>
            </thead>
            
            @foreach ($clientes as $cliente)
                <tr>
                    <td> {{ $cliente['id'] }}</td>
                    <td> {{ $cliente['name'] }}</td>
                    <td> {{ $cliente['telefono'] }}</td>
                    <td> {{ $cliente['correo'] }}</td>
                    <td> {{ $cliente['direccion'] }}</td>
                    <td> {{ $cliente['tipo'] }}</td>        
                </tr>
            @endforeach
        </table>
    </tbody>
    

</div>
    
</body>

</html>