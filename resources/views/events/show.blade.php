@extends('layouts.app')

@section('content')
<h2>Detalles del Evento</h2>

<div class="card">
    <div class="card-header">
        {{ $evento->nombre_evento }}
    </div>
    <div class="card-body">
        <p><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y') }}</p>
        <p><strong>Lugar:</strong> {{ $evento->lugar }}</p>
        <p><strong>Descripción:</strong><br>{{ $evento->descripción }}</p>
    </div>
</div>

<a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
