
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h3 class="mb-4">Clima actual</h3>
        
            @if (isset($error))
                <div class="alert alert-danger">{{ $error }}</div>
            @elseif ($weather)
                @if ($weather['icon'])
                    <img src="https://openweathermap.org/img/wn/{{ $weather['icon'] }}@2x.png" alt="Icono del clima">
                @endif
        
                <ul class="list-group">
                    <li class="list-group-item"><strong>Ciudad:</strong> {{ $weather['city'] }}</li>
                    <li class="list-group-item"><strong>Temperatura:</strong> {{ $weather['temp'] }} °C</li>
                    <li class="list-group-item"><strong>Descripción:</strong> {{ ucfirst($weather['description']) }}</li>
                </ul>
            @else
                <p>No se pudo obtener la información del clima.</p>
            @endif
        
            <a href="#" onclick="window.history.back()" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </body>
</html>

