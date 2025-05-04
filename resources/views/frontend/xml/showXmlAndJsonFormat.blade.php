<!DOCTYPE html>
<html>
<head>
<!--uso de estilos para mostrar cuadros -->
    <title>XML y JSON</title>
    <style>
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border: 1px solid #ccc;
            overflow: auto;

            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body>
    <h1  style="text-align:center;">Visualización de XML y JSON</h1>
        {{--  Si $error no es nula es porque hay errores desde el backend caso contrario se mostraran las variables $xml y $json   --}}
    @isset($error)
        <p style="color: red;">{{ $error }}</p>
    @else
        <div class="container">
            <div class="content">
                <h2 style="text-align:center;">Archivo XML</h2>
                <pre>{!! $xml !!}</pre>

            </div>
            <div class="content">
                <h2 style="text-align:center;">Conversión a JSON</h2>
                <pre>{{ $json }}</pre>
            </div>
        </div>
    @endisset

</body>
</html>
