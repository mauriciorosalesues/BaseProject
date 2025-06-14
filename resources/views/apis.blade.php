
<!DOCTYPE html>
<html lang="en">
 
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Apis</title>
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

</body>
</html>


