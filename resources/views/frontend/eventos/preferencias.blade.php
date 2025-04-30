<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eventos Tecnológicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Eventos Tecnológicos</h2>

        @if (!empty($eventos))
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Lugar</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $evento)
                            <tr>
                                <td>{{ $evento['nombre'] }}</td>
                                <td>{{ $evento['fecha'] }}</td>
                                <td>{{ $evento['lugar'] }}</td>
                                <td>{{ $evento['descripcion'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                No hay eventos disponibles.
            </div>
        @endif
    </div>
</body>
</html>
