@extends('layouts.app')

@section('content')
<h2>Lista de Eventos</h2>

<a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Nuevo Evento</a>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Lugar</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->nombre_evento }}</td>
                <td>{{ $evento->fecha->format('d/m/Y') }}</td>
                <td>{{ $evento->lugar }}</td>
                <td>
                    <a href="{{ route('events.show', $evento->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('events.edit', $evento->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('events.destroy', $evento->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este evento?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $eventos->links() }}
@endsection
