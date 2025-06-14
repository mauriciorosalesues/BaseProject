

# Ingeniería en Desarrollo de Software

## Desarrollo y Técnicas de Aplicaciones Web - DTW135

## APIs Y WEB WORKERS
## EXAMEN PARCIAL 3 - APIS Y WEB WORKERS

### Integrantes del Equipo:

- **Darwin Geovanny Zaldaña Avila**   - ZA20003
- **Luis Miguel Polanco Pacheco**     - PP22054
- **Vilma Melissa Alvarado Parada**   - AP22024
- **William Orlando Rivera Aragón**   - RA22045
- **Wilian Alberto Salinas Vásquez**  - SV99004

## 🎯 Objetivos del proyecto

- Integrar y demostrar el uso de **APIs modernas del navegador**: Geolocalización, Video, Canvas.
- Implementar **Web Workers** para ejecutar tareas fuera del hilo principal.
- Desarrollar en equipo utilizando **control de versiones con Git y GitHub**.
- Organizar el trabajo de forma colaborativa y modular (una API por integrante).

## 🧑‍💻 Funcionalidades implementadas

### 📍 API de Geolocalización
- Captura la ubicación actual del usuario mediante `navigator.geolocation`.
- Muestra un mapa interactivo centrado en la posición del usuario usando **LeafletJS** + **OpenStreetMap**.
- Se muestran las coordenadas (latitud y longitud) en una tabla responsiva.
- Se incluye manejo de errores con `try-catch`.
 
### 📸 API de Video (Cámara Web)
- Acceso a la cámara web del usuario usando `getUserMedia`.
- Permite tomar una fotografía y visualizarla en un canvas.
- Incluye botón para descargar la imagen como `.jpg` (solo del lado del cliente).
- Manejo de errores al no detectar cámara.

### ✏️ API de Canvas
- Área de dibujo libre con mouse usando `<canvas>`.
- Permite guardar el dibujo como imagen `.jpg`.
- Dibujo responsivo con trazo continuo y suave.

### 🧵 Web Workers
- Implementación de un Web Worker para generar 100,000 números aleatorios y ordenarlos.
- El cálculo se realiza en un hilo separado para no bloquear la UI.
- Se muestran los primeros 50 números ordenados en la vista `workers.blade.php`.
- Manejo de errores al enviar datos al worker.
  
## 📂 Vistas implementadas
- `resources/views/apis.blade.php`: Contiene Geolocalización, Cámara Web y Canvas.
- `resources/views/workers.blade.php`: Contiene el ejemplo con Web Workers.

