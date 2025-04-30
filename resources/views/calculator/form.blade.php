<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora SOAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Calculadora SOAP</h1>
        
        @if(isset($result))
            <div class="alert alert-success">
                Resultado de la {{ $operation }}: <strong>{{ $result }}</strong>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('sumar') }}" method="POST" class="mb-3">
                    @csrf
                    <h3>Sumar</h3>
                    <div class="mb-3">
                        <label for="sumA" class="form-label">Número A</label>
                        <input type="number" class="form-control" id="sumA" name="intA" value="{{ old('intA', $intA ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sumB" class="form-label">Número B</label>
                        <input type="number" class="form-control" id="sumB" name="intB" value="{{ old('intB', $intB ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sumar</button>
                </form>
            </div>
            
            <div class="col-md-6">
                <form action="{{ route('multiplicar') }}" method="POST">
                    @csrf
                    <h3>Multiplicar</h3>
                    <div class="mb-3">
                        <label for="mulA" class="form-label">Número A</label>
                        <input type="number" class="form-control" id="mulA" name="intA" value="{{ old('intA', $intA ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mulB" class="form-label">Número B</label>
                        <input type="number" class="form-control" id="mulB" name="intB" value="{{ old('intB', $intB ?? '') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Multiplicar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>