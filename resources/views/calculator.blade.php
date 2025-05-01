<div>
    <!-- Well begun is half done. - Aristotle -->
    <h1>Calculadora</h1>
    
    <form action="{{ route('calculator.result') }}" method="POST">
        @csrf
        <div>
            <label for="numero1">Número 1:</label>
            <input type="number" name="num1" value="{{ old('num1', $num1 ?? '') }}" required>
        </div>
        <div>
            <label for="numero2">Número 2:</label>
            <input type="number" name="num2" value="{{ old('num2', $num2 ?? '') }}" required>
        </div>
        <div>
            <label for="operacion">Operación:</label>
            <select name="operacion" required>
                <option value="sumar" {{ (old('operacion', $operacion ?? '') == 'sumar') ? 'selected' : '' }}>Sumar</option>
                <option value="multiplicar" {{ (old('operacion', $operacion ?? '') == 'multiplicar') ? 'selected' : '' }}>Multiplicar</option>
            </select>
        </div>
        <div>
            <button type="submit">Calcular</button>
        </div>
    </form>

    @if(isset($resultado))
        <h2>Resultado: {{ $resultado }}</h2>
    @endif

    @if(isset($error))
        <p style="color: red;">Error: {{ $error }}</p>
    @endif
</div>
