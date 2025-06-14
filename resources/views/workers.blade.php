<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Web Workers en Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Web Worker: Ordenando 100,000 números</h3>
        </div>
        <div class="card-body">
            <button id="start" class="btn btn-success mb-3">Iniciar cálculo</button>
            <div id="status" class="alert alert-info" role="alert">Presiona el botón para comenzar</div>
            <h5>Primeros 50 resultados ordenados:</h5>
            <pre id="result" class="bg-light border p-3" style="max-height: 300px; overflow-y: auto;"></pre>
        </div>
    </div>
</div>


<script>
    const startBtn = document.getElementById('start');
    const status = document.getElementById('status');
    const result = document.getElementById('result');

    let worker;

    startBtn.addEventListener('click', () => {
        try {
            const numbers = Array.from({ length: 100000 }, () => Math.floor(Math.random() * 1000000));

            if (typeof Worker !== 'undefined') {
                worker = new Worker('/js/worker.js');

                status.className = 'alert alert-warning';
                status.textContent = 'Procesando con Web Worker...';

                worker.postMessage(numbers);

                worker.onmessage = function (e) {
                    if (e.data.error) {
                        status.className = 'alert alert-danger';
                        status.textContent = 'Error: ' + e.data.error;
                    } else {
                        status.className = 'alert alert-success';
                        status.textContent = 'Ordenado correctamente';
                        // Mostramos solo los primeros 50 números
                        result.textContent = JSON.stringify(e.data.slice(0, 50), null, 2);
                    }
                };

                worker.onerror = function (e) {
                    status.className = 'alert alert-danger';
                    status.textContent = 'Error en el worker: ' + e.message;
                };
            } else {
                status.className = 'alert alert-danger';
                status.textContent = 'Tu navegador no soporta Web Workers.';
            }
        } catch (err) {
            status.className = 'alert alert-danger';
            status.textContent = 'Error general: ' + err.message;
        }
    });
</script>

</body>
</html>
