// worker.js
self.onmessage = function(event) {
    try {
        // Recibe el arreglo de números desde el hilo principal
        let numeros = event.data;

        // Verifica que sea un arreglo válido antes de hacer el calculo
        if (!Array.isArray(numeros)) {
            throw new Error("Los datos recibidos no son un arreglo.");
        }

        // Filtra los números para que solo estén en el rango de 1 a 100,000
        numeros = numeros.filter(n => typeof n === 'number' && n >= 1 && n <= 100000);

        // Mezcla el arreglo aleatoriamente (Fisher-Yates shuffle)
        for (let i = numeros.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [numeros[i], numeros[j]] = [numeros[j], numeros[i]];
        }

        // Toma 50 números aleatorios y los ordena de menor a mayor
        const seleccionados = numeros.slice(0, 50).sort((a, b) => a - b);

        // Envía de vuelta los 50 números ordenados
        self.postMessage(seleccionados);

    } catch (error) {
        // Envia el mensaje de error al hilo principal
        self.postMessage({ error: error.message });
    }
};
