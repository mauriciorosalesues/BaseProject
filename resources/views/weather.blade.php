<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clima Actual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body text-center">
                <h3 class="mb-4">Clima actual</h3>

                <div id="weather-info">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p class="mt-2">Obteniendo información del clima...</p>
                </div>

                <a href="#" onclick="window.history.back()" class="btn btn-secondary mt-3">Volver</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const apiKey = "{{ config('services.openweather.key') }}";
        const city = 'San Salvador';

        axios.get('https://api.openweathermap.org/data/2.5/weather', {
            params: {
                q: city,
                appid: apiKey,
                units: 'metric',
                lang: 'es'
            }
        })
        .then(response => {
            const data = response.data;
            const weather = {
                city: data.name,
                temp: data.main.temp,
                description: data.weather[0].description,
                icon: data.weather[0].icon
            };

            document.getElementById('weather-info').innerHTML = `
                <img src="https://openweathermap.org/img/wn/${weather.icon}@2x.png" alt="Icono del clima" class="mb-3">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Ciudad:</strong> ${weather.city}</li>
                    <li class="list-group-item"><strong>Temperatura:</strong> ${weather.temp} °C</li>
                    <li class="list-group-item"><strong>Descripción:</strong> ${weather.description.charAt(0).toUpperCase() + weather.description.slice(1)}</li>
                </ul>
            `;
        })
        .catch(error => {
            console.error(error);
            document.getElementById('weather-info').innerHTML = `
                <div class="alert alert-danger">No se pudo obtener el clima. Intente más tarde.</div>
            `;
        });
    </script>
</body>
</html>
