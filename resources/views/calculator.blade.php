<div>
    <!-- Well begun is half done. - Aristotle -->
    @extends('backend.menus.superior')

    @section('content-admin-css')
        <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
        <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
    @stop

    <section class="content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <h1>Calculadora</h1>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid" style="margin-left: 15px">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Ingrese los numeros a calcular:</h3>
                        </div>
                        <form action="{{ route('calculator.result') }}" method="POST" style="margin: 0px">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="numero1" class="text-muted">Número 1:</label>
                                    <input type="number" class="form-control" name="num1" value="{{ old('num1', $num1 ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero2" class="text-muted">Número 2:</label>
                                    <input type="number" class="form-control" name="num2" value="{{ old('num2', $num2 ?? '') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="operacion" class="text-muted">Operación:</label>
                                    <select name="operacion" class="form-control" required>
                                        <option value="sumar" {{ (old('operacion', $operacion ?? '') == 'sumar') ? 'selected' : '' }}>Sumar</option>
                                        <option value="multiplicar" {{ (old('operacion', $operacion ?? '') == 'multiplicar') ? 'selected' : '' }}>Multiplicar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Calcular</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid" style="margin-left: 15px">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Resultado:</h3>
                        </div>
                        <div class="card-body text-center text-muted">
                            @if(isset($resultado))
                                <h1>{{ $resultado }}</h1>
                            @endif
                            @if(isset($error))
                                <p style="color: red;">Error: {{ $error }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
