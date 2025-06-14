<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Web Workers en Laravel</title>
</head>
<body>
    <h1>Web Worker: Ordenando 100,000 números</h1>
    <button id="start">Iniciar cálculo</button>
    <p id="status"></p>
    <pre id="result"></pre>

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

                    status.textContent = 'Procesando con Web Worker...';

                    worker.postMessage(numbers);

                    worker.onmessage = function (e) {
                        if (e.data.error) {
                            status.textContent = 'Error: ' + e.data.error;
                        } else {
                            status.textContent = 'Ordenado';
                            result.textContent = JSON.stringify(e.data, null, 2);
                        }
                    };

                    worker.onerror = function (e) {
                        status.textContent = 'Error en el worker: ' + e.message;
                    };
                } else {
                    status.textContent = 'Tu navegador no soporta Web Workers.';
                }
            } catch (err) {
                status.textContent = 'Error general: ' + err.message;
            }
        });
    </script>
</body>
</html>
