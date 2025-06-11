<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Proyecto: Examen Parcial 2 - DTW135

## Integrantes del grupo de trabajo
- David Salomón Martínez Valladares - MV12013
- Luis Eduardo Guiroa Linares - GL12016
- Erick Giovanni Monroy López - ML22048
- Román Edgardo Mendoza Arias - MA22054
- David Alfredo Parada Mendoza - PM13119

## Descripción

## Instrucciones de instalación

A continuación se detallan los pasos para instalar y ejecutar el proyecto desde cero en tu entorno local:

1. Clonar el repositorio

```bash
git clone https://github.com/r3mM3nD3v/Parcial-3.git
cd Parcial-3
```

2. Instalar dependencias de PHP con Composer

Asegúrate de tener Composer instalado. Luego ejecuta:

```bash
composer install
```

3. Instalar dependencias de JavaScript con npm

Asegúrate de tener Node.js y npm instalados. Luego ejecuta:

```bash
npm install
```

4. Configurar el archivo de entorno

Luego, abre el archivo `.env` y ajusta los valores de la base de datos y otras variables necesarias.

5. Configuración de la base de datos (XAMPP y MySQL)

Este proyecto utiliza XAMPP y MySQL para la gestión de la base de datos. Por defecto, se utilizan los siguientes valores en el archivo .env:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Por lo tanto, debes crear una base de datos llamada laravel en tu servidor MySQL local (puedes hacerlo desde phpMyAdmin o la consola de MySQL). No es necesario establecer contraseña para el usuario root si usas la configuración por defecto de XAMPP.

6. Generar la clave de la aplicación

Ejecuta el siguiente comando:

```bash
php artisan key:generate
```

7. Ejecutar migraciones

Para crear las tablas necesarias en la base de datos, ejecuta:

```bash
php artisan migrate
```

8. Cargar datos de ejemplo

El repositorio incluye seeders para poblar la base de datos con usuarios de ejemplo. Ejecuta

```bash
php artisan db:seed
```

9. Levantar el servidor de desarrollo

Finalmente, inicia el servidor local de Laravel:

```bash
php artisan serve
```

El proyecto estará disponible en http://localhost:8000.

## Uso de la aplicación

Ingresa con las credenciales de admin
```
usuario: admin
contraseña: 1234
```

## 1. API de Geolocalización
- Tarea: Implementar una funcionalidad que obtenga la ubicación actual del usuario.



## 2. API de Canvas
- Tarea: Permitir que el usuario dibuje sobre un canvas.



## 3. API de Video
- Tarea: Acceder y mostrar la cámara del usuario.



## 4. Web Workers
- Tarea: Implementar un ejemplo que use Web Workers para tareas fuera del hilo principal.

- Archivos:
  - `public/js/sortWorker.js:` Este es el archivo del Web Worker. Recibe una lista de números, los ordena utilizando el algoritmo <i>Quicksort</i> y devuelve el resultado al hilo principal. Funciona en segundo plano para no bloquear la interfaz de usuario.
  - `public/js/workers-app.js:` Este es el script principal de la aplicación. Genera los números aleatorios, inicia el Web Worker, recibe los resultados ordenados y los muestra en la vista. También maneja los errores y la interacción del usuario.
  - `resources/views/workers.blade.php:` Esta es la vista Blade de Laravel. Define la estructura HTML de la página, incluyendo los botones, los mensajes de estado y el área donde se muestran los resultados. Utiliza el script workers-app.js para la lógica de la aplicación.
- Uso
1. En la barra de direcciones, escribe la URL de la aplicación Laravel seguida de /workers, deberás ingresar http://localhost:8000/workers o hacer click en la opción de Workers en el sidemenu.
2. Una vez que ingreses a la página, esta se cargará mostrando un botón para generar y ordenar números.
3. Este botón iniciará el proceso de generación y ordenamiento de los números utilizando un Web Worker en segundo plano.
4. Verás mensajes de estado que te indicarán el progreso del proceso. Una vez completado, se mostrarán los primeros 50 números ordenados, junto con información adicional como el número más pequeño y el más grande.
5. Si deseas detener el proceso en cualquier momento, puedes hacer clic en el botón "Detener Worker".
6. Si deseas puedes modificar la cantidad de números a calcular y a mostrar para probar la funcionalidad del web worker.
7. Puedes ver el proceso con mensajes de consola.

