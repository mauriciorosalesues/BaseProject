<!DOCTYPE html>
<html>
<head>
   <title>Web Worker con Fetch</title>
</head>
<body>
   <h2>Procesamiento de usuarios con Web Worker</h2>
   <button onclick="cargarDatos()">Cargar usuarios</button>
   <p id="status">Esperando acción...</p>
   <div id="resultado"></div>

   <script>
       let worker = new Worker('/js/userWorker.js');

       function cargarDatos() {
           document.getElementById('status').innerText = 'Cargando y procesando...';
           worker.postMessage('iniciar');

           worker.onmessage = function (e) {
               const data = e.data;
               document.getElementById('status').innerText = 'Completado';
               document.getElementById('resultado').innerHTML = `
                   <ul>
                       <li>Total de usuarios: ${data.total}</li>
                       <li>Promedio de edad: ${data.averageAge}</li>
                       <li>Hombres: ${data.males}</li>
                       <li>Mujeres: ${data.females}</li>
                   </ul>
               `;
           };
       }
   </script>
</body>
</html>
