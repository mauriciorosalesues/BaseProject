@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
@stop

<div id="divcontenedor" style="display: none">
    <section class="content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <h1>Libros</h1>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Mostrar los datos en formato JSON -->
            <div class="card mb-5">
                <div class="card-header">
                    <strong>Datos en formato JSON</strong>
                </div>
                <div class="card-body">
                    <pre class="mb-0">{{ json_encode($libros, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </div>
            </div>

            <!-- Mostrar los datos en formato tabla -->
            <div class="card">
                <div class="card-header">
                    <strong>Tabla de Libros</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Año</th>
                                <th>Editorial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($libros['libro'] as $libro)
                            <tr>
                                <td>{{ $libro['titulo'] }}</td>
                                <td>{{ $libro['autor'] }}</td>
                                <td>{{ $libro['anio'] }}</td>
                                <td>{{ $libro['editorial'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')
    <script>
        $(document).ready(function(){
            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>
@stop
