<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--Libreria alertas -->
</head>
<body>
    <div class="container h-100 mt-5">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <h3>Editar cliente</h3>

                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST" id="formulario">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $cliente->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $cliente->telefono }}" required>
                    </div>

                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="{{ $cliente->correo }}" required>
                    </div>

                    <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de Cliente:</label>
                        <select id="tipo" name="tipo" class="form-control" required>
                            <option value=""></option>
                            <option value="Nuevo" {{ $cliente->tipo == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                            <option value="Frecuente" {{ $cliente->tipo == 'Frecuente' ? 'selected' : '' }}>Frecuente</option>
                            <option value="Preferencial" {{ $cliente->tipo == 'Preferencial' ? 'selected' : '' }}>Preferencial</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-2">Actualizar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
    <script src={{ asset('js/cliente.js') }}></script>
</body>
</html>

