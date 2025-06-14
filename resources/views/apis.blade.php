
<!DOCTYPE html>
<html lang="en">
 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Apis</title>
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
    {{-- API de Video --}}

<div class="container-fluid mt-5">
    <div class="col-md-12">

        <div class="alert alert-info mt-3 text-center" role="alert">
            <h4>Captura desde la cámara web</h4>
        </div>

        <video id="video" width="100%" height="240" autoplay class="border border-secondary mb-2"></video>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" id="snap">Tomar Foto</button>
            <a id="download" download="captura.jpg" class="btn btn-success mt-2 d-none">Descargar Imagen</a>
        </div>

        <canvas id="canvas" width="640" height="480" class="mt-3 border border-secondary w-100"></canvas>
    </div>
</div>



<!-- Script Camara -->
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const snapBtn = document.getElementById('snap');
    const downloadLink = document.getElementById('download');
    const context = canvas.getContext('2d');

    // Acceder a la cámara
    try {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
        })
        } catch (error) {
            alert("Error al acceder a la cámara: " + error.message);
            console.error("Error al acceder a la cámara:", error);
        }
        
    // Capturar foto y mostrar
    snapBtn.addEventListener('click', function () {
        try {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
        } catch (error) {
            alert("Error al capturar la imagen: " + error.message);
            return;
        }
        
        const dataUrl = canvas.toDataURL('image/jpeg');
        
        downloadLink.href = dataUrl;
        downloadLink.classList.remove('d-none');
    });
</script>
    
<div class="text-center d-flex justify-content-center align-items-center vh-50 flex-column">

<div class="shadow-lg p-3 mb-4 bg-body-tertiary rounded mt-3 w-50 p-3">
    <h1>
        geolocalización con leaflet
    </h1>
</div>

<div class="alert alert-warning p-3 w-50" role="alert">
    para que funcione correctamente, asegúrate de permitir el acceso a tu ubicación cuando se te solicite.
</div>

</div>

<div class="container-fluid">
<div class="row">
    <div class="col-md-8">
        <div id="map"></div>
    </div>
    <div class="col-md-4">

        <div class="alert alert-secondary mt-3" role="alert">
            <h4>coordenadas geográficas</h4>
        </div>

        <table class="table table-hover table-bordered border-secondary">
            <thead class="table-active">
                <tr>
                    <th scope="col"><table>tipo</table></th>
                    <th scope="col">valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">latitud:</th>
                    <td><span id="lat"></span></td>
                </tr>
                <tr>
                    <th scope="row">longitud:</th>
                    <td><span id="lon"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>


<!-- leaflet js -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
try {
    navigator.geolocation.getcurrentposition(
        function (position) {
            try {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;

                document.getelementbyid('lat').textcontent = lat;
                document.getelementbyid('lon').textcontent = lon;

                const map = l.map('map').setview([lat, lon], 15);

                l.tilelayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; openstreetmap contributors'
                }).addto(map);

                l.marker([lat, lon]).addto(map)
                    .bindpopup("esta es tu ubicación actual").openpopup();
            } catch (maperror) {
                alert("error al mostrar el mapa: " + maperror.message);
                console.error(maperror);
            }
        },
        function (error) {
            alert("error obteniendo ubicación: " + error.message);
            console.error(error);
        },
        {
            enablehighaccuracy: true,
            timeout: 10000,
            maximumage: 0
        }
    );
} catch (geoerror) {
    alert("error general al acceder a la geolocalización.");
    console.error(geoerror);
}
</script>



</body>
</html>


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
                geolocalización con leaflet
            </h1>
        </div>

        <div class="alert alert-warning p-3 w-50" role="alert">
            para que funcione correctamente, asegúrate de permitir el acceso a tu ubicación cuando se te solicite.
        </div>
        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div id="map"></div>
            </div>
            <div class="col-md-4">

                <div class="alert alert-secondary mt-3" role="alert">
                    <h4>coordenadas geográficas</h4>
                </div>

                <table class="table table-hover table-bordered border-secondary">
                    <thead class="table-active">
                        <tr>
                            <th scope="col"><table>tipo</table></th>
                            <th scope="col">valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">latitud:</th>
                            <td><span id="lat"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">longitud:</th>
                            <td><span id="lon"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- leaflet js -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        try {
            navigator.geolocation.getcurrentposition(
                function (position) {
                    try {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;

                        document.getelementbyid('lat').textcontent = lat;
                        document.getelementbyid('lon').textcontent = lon;

                        const map = l.map('map').setview([lat, lon], 15);

                        l.tilelayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; openstreetmap contributors'
                        }).addto(map);

                        l.marker([lat, lon]).addto(map)
                            .bindpopup("esta es tu ubicación actual").openpopup();
                    } catch (maperror) {
                        alert("error al mostrar el mapa: " + maperror.message);
                        console.error(maperror);
                    }
                },
                function (error) {
                    alert("error obteniendo ubicación: " + error.message);
                    console.error(error);
                },
                {
                    enablehighaccuracy: true,
                    timeout: 10000,
                    maximumage: 0
                }
            );
        } catch (geoerror) {
            alert("error general al acceder a la geolocalización.");
            console.error(geoerror);
        }
    </script>

</body>
</html>
