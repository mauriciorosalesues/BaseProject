<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Web Workers</title>
    <style>
        #resultado {
            max-width: 600px;
            margin: auto;
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header text-center" style="background: linear-gradient(90deg, #b03a2e 60%, #922b21 100%); color: #fff;">
                        <h2 class="mb-0" style="letter-spacing: 1px;">Ordenar 100,000 Números con <span style="color: #f7ca18;">Web Worker</span></h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead mb-4" style="color: #555;">
                            Haz clic en el botón para generar y ordenar 100,000 números aleatorios usando un Web Worker.<br>
                            ¡Disfruta de una experiencia rápida y sin bloqueos!
                        </p>
                        <button class="btn btn-lg" style="background: linear-gradient(90deg, #b03a2e 60%, #f7ca18 100%); color: #fff; font-weight: bold; box-shadow: 0 4px 12px rgba(176,58,46,0.15);" onclick="iniciarWorker()">
                            🚀 Iniciar Cálculo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="resultado"></div>

    <script>
        function iniciarWorker() {
            try {
                const resultado = document.getElementById('resultado');
                resultado.textContent = 'Generando números y enviando al Worker...';

                // Genera los  100,000 números aleatorios.
                const numeros = Array.from({
                    length: 100000
                }, () => Math.floor(Math.random() * 1000000));

                // Crea el Worker
                const worker = new Worker('/js/worker.js');

                // Enviar datos al Worker
                worker.postMessage(numeros);

                // Recibe respuesta del Worker
                worker.onmessage = function(event) {
                    if (event.data.error) {
                        resultado.textContent = 'Error del Worker: ' + event.data.error;
                    } else {
                        let tablaHTML = `
            <h4 class="text-center">Primeros 50 números ordenados</h4>
            <table class="table table-bordered table-striped table-hover mt-3 text-center">
                <thead class="table-dark">
                   <tr><th>N°</th> <th>Números Ordenados</th></tr>
                </thead>
                <tbody>
        `;

                        event.data.forEach((numero, index) => {
                            tablaHTML += `<tr><td>${index + 1}</td><td>${numero}</td></tr>`;
                        });

                        tablaHTML += `
                </tbody>
            </table>
        `;
                        resultado.innerHTML = tablaHTML;
                    }
                };

                // Manejo de errores del Worker
                worker.onerror = function(error) {
                    resultado.textContent = 'Error en el Worker: ' + error.message;
                };
            } catch (e) {
                document.getElementById('resultado').textContent = 'Error general: ' + e.message;
            }
        }
    </script>
</body>

</html>
