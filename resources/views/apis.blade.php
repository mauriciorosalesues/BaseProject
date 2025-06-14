<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Geolocalización con Leaflet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 20px;
        }
        #map {
            height: 400px;
            width: 100%;
            border: 2px solid #adadad;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    
    <div class="text-center d-flex justify-content-center align-items-center vh-50 flex-column">

        <div class="shadow-lg p-3 mb-4 bg-body-tertiary rounded mt-3 w-50 p-3">
            <h1>
                Geolocalización con Leaflet
            </h1>
        </div>

        <div class="alert alert-warning p-3 w-50" role="alert">
            Para que funcione correctamente, asegúrate de permitir el acceso a tu ubicación cuando se te solicite.
        </div>
        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div id="map"></div>
            </div>
            <div class="col-md-4">

                <div class="alert alert-secondary mt-3" role="alert">
                    <h4>Coordenadas geográficas</h4>
                </div>

                <table class="table table-hover table-bordered border-secondary">
                    <thead class="table-active">
                        <tr>
                            <th scope="col"><Table>Tipo</Table></th>
                            <th scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Latitud:</th>
                            <td><span id="lat"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Longitud:</th>
                            <td><span id="lon"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        try {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    try {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;

                        document.getElementById('lat').textContent = lat;
                        document.getElementById('lon').textContent = lon;

                        const map = L.map('map').setView([lat, lon], 15);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);

                        L.marker([lat, lon]).addTo(map)
                            .bindPopup("Esta es tu ubicación actual").openPopup();
                    } catch (mapError) {
                        alert("Error al mostrar el mapa: " + mapError.message);
                        console.error(mapError);
                    }
                },
                function (error) {
                    alert("Error obteniendo ubicación: " + error.message);
                    console.error(error);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } catch (geoError) {
            alert("Error general al acceder a la geolocalización.");
            console.error(geoError);
        }
    </script>

</body>
</html>
