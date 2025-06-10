@extends('backend.menus.superior')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>APIs del Navegador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        #map {
            height: 400px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        #canvas,
        #fotoCanvas {
            border: 1px solid #000;
            cursor: crosshair;
        }

        .seccion {
            padding: 30px 0;
            border-top: 2px solid #ccc;
            margin-top: 30px;
        }

        body {
            transition: background-color 0.3s, color 0.3s;
        }
    </style>
</head>

<body class="bg-light text-dark">


    <!-- Secciones de uso de APIS -->
    <div class="container mt-4">

        <!-- Navegación de Secciones Interna -->
        <div class="d-flex justify-content-center mb-4 gap-2">
            <button class="btn btn-outline-primary me-2" onclick="mostrarSeccion('geo')">
                🌍 Geolocalización
            </button>
            <button class="btn btn-outline-success me-2" onclick="mostrarSeccion('canvas')">
                🎨 Canvas
            </button>
            <button class="btn btn-outline-danger" onclick="mostrarSeccion('camara')">
                📷 Cámara
            </button>
        </div>

        <!-- SECCIÓN 1: Geolocalización -->
        <div id="seccionGeo" class="seccion d-none">
            <h2 class="mb-4">1. Geolocalización</h2>
            <p>Esta sección usa la API de geolocalización del navegador para mostrar tu ubicación actual en un mapa.</p>

            <div class="mb-3 d-flex flex-wrap gap-2">
                <button class="btn btn-primary" onclick="getLocation()">
                    <i class="bi bi-geo-alt-fill"></i> Obtener mi ubicación
                </button>
                <button class="btn btn-secondary" onclick="resetMap()">
                    <i class="bi bi-arrow-counterclockwise"></i> Reiniciar mapa
                </button>
                <button class="btn btn-dark" onclick="toggleDarkMode()">
                    <i class="bi bi-moon-stars-fill"></i> Modo oscuro
                </button>
            </div>

            <div id="spinner" class="mb-3 text-center d-none">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Cargando ubicación...</span>
                </div>
            </div>

            <div id="map" class="border"></div>
            <p id="coords" class="text-muted mt-2"></p>
        </div>

        <!-- SECCIÓN 2: Canvas -->
        <div id="seccionCanvas" class="seccion d-none">
            <h2 class="mb-4">2. Dibujo Interactivo (Canvas)</h2>
            <p>Selecciona la herramienta que deseas usar y dibuja en el lienzo. Puedes guardar tu dibujo o limpiar el área.</p>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="toolSelect" class="form-label">Herramienta:</label>
                    <select id="toolSelect" class="form-select">
                        <option value="pencil">Línea continua</option>
                        <option value="circle">Círculo</option>
                        <option value="rect">Rectángulo</option>
                    </select>
                </div>
            </div>

            <canvas id="canvas" width="700" height="300"></canvas>

            <div class="mt-3">
                <button class="btn btn-success me-2" onclick="guardarImagen()">Guardar como JPG</button>
                <button class="btn btn-secondary" onclick="limpiarCanvas()">Limpiar Lienzo</button>
            </div>
        </div>

        <!-- SECCIÓN 3: Captura desde Cámara -->
        <div id="seccionCamara" class="seccion d-none">
            <h2 class="mb-4">3. Captura desde Cámara</h2>
            <p>Activa tu cámara, toma una foto y guarda la imagen localmente.</p>

            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <video id="video" autoplay playsinline class="border rounded shadow" width="320" height="240"></video><br>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <button class="btn btn-outline-primary" id="btnSolicitarCamara">
                            <i class="bi bi-unlock-fill"></i> Solicitar cámara
                        </button>
                        <button class="btn btn-danger" id="btnFoto">
                            <i class="bi bi-camera-fill"></i> Tomar Foto
                        </button>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <canvas id="fotoCanvas" width="320" height="240" class="border rounded shadow"></canvas><br>
                    <a id="btnDescargar" class="btn btn-success mt-2" download="foto.png">
                        <i class="bi bi-download"></i> Descargar Foto
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!--CONFIRMACIÓN -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
        <div id="toastFoto" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    ✅ ¡Foto descargada con éxito!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
        </div>
    </div>
</body>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // --- GEOLOCALIZACIÓN ---
    let map;

    function getLocation() {
        document.getElementById("spinner").classList.remove("d-none");
        
        try {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocalización no soportada.");
                document.getElementById("spinner").classList.add("d-none");
            }
        } catch (error) {
            alert("Ocurrió un error al intentar obtener la ubicación.");
            document.getElementById("spinner").classList.add("d-none");
            console.error(error);
        }
    }

    function showPosition(position) {
        try {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            document.getElementById("spinner").classList.add("d-none");
            document.getElementById("coords").textContent = `Latitud: ${lat.toFixed(5)}, Longitud: ${lon.toFixed(5)}`;
            if (!map) {
                map = L.map('map').setView([lat, lon], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
            } else {
                map.setView([lat, lon], 13);
            }
            L.marker([lat, lon]).addTo(map).bindPopup("¡Estás aquí!").openPopup();
        } catch (error) {
            document.getElementById("spinner").classList.add("d-none");
            alert("Ocurrió un error al mostrar la ubicación.");
            console.error(error);
        }
    }

    function showError(error) {
        try {
            document.getElementById("spinner").classList.add("d-none");
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Permiso denegado.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Ubicación no disponible.");
                    break;
                case error.TIMEOUT:
                    alert("Tiempo excedido.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Error desconocido.");
                    break;
            }
        } catch (e) {
            alert("Ocurrió un error al manejar el error de geolocalización.");
            console.error(e);
        }
    }

    function resetMap() {
        if (map) {
            map.remove();
            map = null;
            document.getElementById("coords").textContent = "";
        }
    }

    function toggleDarkMode() {
        document.body.classList.toggle('bg-light');
        document.body.classList.toggle('bg-dark');
        document.body.classList.toggle('text-dark');
        document.body.classList.toggle('text-light');
    }

    // --- CANVAS INTERACTIVO ---
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const tool = document.getElementById("toolSelect");

    let dibujando = false,
        startX = 0,
        startY = 0;

    canvas.addEventListener("mousedown", (e) => {
        dibujando = true;
        startX = e.offsetX;
        startY = e.offsetY;
        if (tool.value === "pencil") {
            ctx.beginPath();
            ctx.moveTo(startX, startY);
        }
    });

    canvas.addEventListener("mousemove", (e) => {
        if (!dibujando) return;
        const x = e.offsetX;
        const y = e.offsetY;
        if (tool.value === "pencil") {
            ctx.lineTo(x, y);
            ctx.strokeStyle = "black";
            ctx.lineWidth = 1.5;
            ctx.stroke();
        }
    });

    canvas.addEventListener("mouseup", (e) => {
        if (!dibujando) return;
        dibujando = false;
        const endX = e.offsetX;
        const endY = e.offsetY;
        ctx.strokeStyle = "black";
        ctx.lineWidth = 1.5;
        if (tool.value === "circle") {
            const radio = Math.sqrt((endX - startX) ** 2 + (endY - startY) ** 2);
            ctx.beginPath();
            ctx.arc(startX, startY, radio, 0, 2 * Math.PI);
            ctx.stroke();
        }
        if (tool.value === "rect") {
            const width = endX - startX;
            const height = endY - startY;
            ctx.beginPath();
            ctx.rect(startX, startY, width, height);
            ctx.stroke();
        }
    });

    function guardarImagen() {
        try {
            const tempCanvas = document.createElement('canvas');
            const tempCtx = tempCanvas.getContext('2d');
            tempCanvas.width = canvas.width;
            tempCanvas.height = canvas.height;
            tempCtx.fillStyle = "white";
            tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
            tempCtx.drawImage(canvas, 0, 0);
            const enlace = document.createElement('a');
            enlace.download = "mi_dibujo.jpg";
            enlace.href = tempCanvas.toDataURL("image/jpeg", 1.0);
            enlace.click();
        } catch (error) {
            alert("Ocurrió un error al guardar la imagen.");
            console.error(error);
        }
    }

    function limpiarCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    // --- CÁMARA / VIDEO ---
    const video = document.getElementById('video');
    const fotoCanvas = document.getElementById('fotoCanvas');
    const ctxFoto = fotoCanvas.getContext('2d');
    const btnFoto = document.getElementById('btnFoto');
    const btnDescargar = document.getElementById('btnDescargar');
    const btnSolicitarCamara = document.getElementById('btnSolicitarCamara');

    let streamActivo = null;

    function solicitarCamara() {
        try {
            if (streamActivo) {
                // Detener flujo anterior
                streamActivo.getTracks().forEach(track => track.stop());
                streamActivo = null;
            }

            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    streamActivo = stream;
                    video.srcObject = stream;
                })
                .catch(error => {
                    alert("No se pudo acceder a la cámara.");
                    console.error(error);
                });
        } catch (error) {
            alert("Ocurrió un error al solicitar la cámara.");
            console.error(error);
        }
    }

    // Solicitar al cargar
    solicitarCamara();

    // Botón manual para pedir permisos
    btnSolicitarCamara.addEventListener('click', solicitarCamara);

    // Tomar foto
    btnFoto.addEventListener('click', () => {
        try {
            ctxFoto.drawImage(video, 0, 0, fotoCanvas.width, fotoCanvas.height);
            btnDescargar.href = fotoCanvas.toDataURL('image/png');
        } catch (error) {
            alert("Ocurrió un error al tomar la foto.");
            console.error(error);
        }
    });

    // Descargar y limpiar
    btnDescargar.addEventListener('click', () => {
        try {
            setTimeout(() => {
                ctxFoto.clearRect(0, 0, fotoCanvas.width, fotoCanvas.height);
            }, 100);

            // Mostrar toast de éxito
            const toast = new bootstrap.Toast(document.getElementById('toastFoto'));
            toast.show();
        } catch (error) {
            alert("Ocurrió un error al limpiar el canvas o mostrar la notificación.");
            console.error(error);
        }
    });

    // vistas
    function mostrarSeccion(seccion) {
        try {
            // Oculta todas las secciones
            document.getElementById('seccionGeo').classList.add('d-none');
            document.getElementById('seccionCanvas').classList.add('d-none');
            document.getElementById('seccionCamara').classList.add('d-none');

            // Muestra solo la correspondiente
            if (seccion === 'geo') {
                document.getElementById('seccionGeo').classList.remove('d-none');
            } else if (seccion === 'canvas') {
                document.getElementById('seccionCanvas').classList.remove('d-none');
            } else if (seccion === 'camara') {
                document.getElementById('seccionCamara').classList.remove('d-none');
            }
        } catch (error) {
            alert("Ocurrió un error al mostrar la sección.");
            console.error(error);
        }
    }

    // Mostrar la sección predeterminada (geolocalización)
    document.addEventListener('DOMContentLoaded', function() {
        mostrarSeccion('geo');
    });
</script>


</html>