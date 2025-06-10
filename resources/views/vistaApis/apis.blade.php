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

        #canvas {
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
    <div class="container mt-4">

        <!-- SECCIÓN 1: Geolocalización -->
        <div class="seccion">
            <h2 class="mb-4">1. Geolocalización</h2>
            <p>Esta sección usa la API de geolocalización del navegador para mostrar tu ubicación actual en un mapa.</p>

            <div class="mb-3 d-flex flex-wrap gap-2">
                <button class="btn btn-primary d-flex align-items-center gap-2" onclick="getLocation()">
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

        <!-- SECCIÓN 2: Canvas Interactivo -->
        <div class="seccion">
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

            <canvas id="canvas" width="600" height="400"></canvas>

            <div class="mt-3">
                <button class="btn btn-success me-2" onclick="guardarImagen()">Guardar como JPG</button>
                <button class="btn btn-secondary" onclick="limpiarCanvas()">Limpiar Lienzo</button>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // --- GEOLOCALIZACIÓN ---
        let map;

        function getLocation() {
            document.getElementById("spinner").classList.remove("d-none");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocalización no soportada.");
                document.getElementById("spinner").classList.add("d-none");
            }
        }

        function showPosition(position) {
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

            L.marker([lat, lon]).addTo(map)
                .bindPopup("¡Estás aquí!")
                .openPopup();
        }

        function showError(error) {
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
        }

        function resetMap() {
            if (map) {
                map.remove();
                map = null;
                document.getElementById("coords").textContent = "";
            }
        }

        function toggleDarkMode() {
            const body = document.body;
            body.classList.toggle('bg-light');
            body.classList.toggle('bg-dark');
            body.classList.toggle('text-dark');
            body.classList.toggle('text-light');
        }

        // --- CANVAS ---
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        const tool = document.getElementById("toolSelect");

        let dibujando = false;
        let startX = 0;
        let startY = 0;

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
                const radio = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
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
    </script>
</body>

</html>


    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // --- GEOLOCALIZACIÓN ---
        let map;
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocalización no soportada.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            if (!map) {
                map = L.map('map').setView([lat, lon], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
            } else {
                map.setView([lat, lon], 13);
            }

            L.marker([lat, lon]).addTo(map)
                .bindPopup("¡Estás aquí!")
                .openPopup();
        }

        function showError(error) {
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
        }

        // --- CANVAS ---
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");
        const tool = document.getElementById("toolSelect");

        let dibujando = false;
        let startX = 0;
        let startY = 0;

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
                const radio = Math.sqrt(Math.pow(endX - startX, 2) + Math.pow(endY - startY, 2));
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
                // Crear un canvas temporal
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');

                // Mismos tamaños
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;

                // Fondo blanco
                tempCtx.fillStyle = "white";
                tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);

                // Copiar dibujo original
                tempCtx.drawImage(canvas, 0, 0);

                // Descargar como JPG
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
    </script>
</body>

</html>