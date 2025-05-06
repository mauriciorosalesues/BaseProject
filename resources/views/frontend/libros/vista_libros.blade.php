<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .genre-badge {
            font-size: 0.8rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4 text-center text-primary">Biblioteca</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @php
                $libros = json_decode($librosEnFormatoJson, true);
            @endphp

            @if(isset($libros['Libro']) && count($libros['Libro']) > 0)
                @foreach($libros['Libro'] as $libro)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h5 mb-0">{{ $libro['Titulo'] ?? 'Título no disponible' }}</h2>
                            </div>
                            <div class="card-body">
                                <dl class="mb-0">
                                    <dt>Autor:</dt>
                                    <dd class="mb-2">{{ $libro['Autor'] ?? 'Autor desconocido' }}</dd>

                                    <dt>Año de publicación:</dt>
                                    <dd class="mb-2">{{ $libro['Anio'] ?? 'N/A' }}</dd>

                                    <dt>Género:</dt>
                                    <dd>
                                        <span class="badge bg-secondary genre-badge">
                                            {{ $libro['Genero'] ?? 'Sin género especificado' }}
                                        </span>
                                    </dd>
                                </dl>
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted">Obra literaria clásica</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No se encontraron libros en el catálogo
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>