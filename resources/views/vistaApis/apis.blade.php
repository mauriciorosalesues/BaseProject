@extends('backend.menus.superior')

<!-- Geolocalización -->
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Geolocalización</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap 5 -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Leaflet CSS -->
   <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

   <style>
       #map {
           height: 400px;
       }
   </style>
</head>
<body>

<div class="container mt-4">
   <h2 class="mb-4">Mi Ubicación Actual</h2>
   <button class="btn btn-primary mb-3" onclick="getLocation()">Obtener mi ubicación</button>
   <div id="map" class="border"></div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
   let map;

   function getLocation() {
       console.log("Obteniendo ubicación...");
       if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(showPosition, showError);
       } else {
           alert("Geolocalización no soportada.");
       }
   }

   function showPosition(position) {
       const lat = position.coords.latitude;
       const lon = position.coords.longitude;
       console.log("Ubicación: ", lat, lon);

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
       console.error("Error al obtener ubicación:", error);
       switch (error.code) {
           case error.PERMISSION_DENIED:
               alert("Permiso denegado para obtener ubicación.");
               break;
           case error.POSITION_UNAVAILABLE:
               alert("Ubicación no disponible.");
               break;
           case error.TIMEOUT:
               alert("Tiempo de espera excedido.");
               break;
           case error.UNKNOWN_ERROR:
               alert("Error desconocido.");
               break;
       }
   }
</script>

</body>
</html>
