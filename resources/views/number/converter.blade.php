@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-language me-2"></i>Conversor Numérico
                        </h3>
                        <div id="number-animation" class="number-animation">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    @if(session('result'))
                        <div class="alert alert-{{ session('result.success') ? 'success' : 'danger' }} alert-dismissible fade show">
                            @if(session('result.success'))
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle fa-2x me-3"></i>
                                    <div>
                                        <h4 class="alert-heading mb-1">¡Conversión Exitosa!</h4>
                                        <div class="conversion-result">
                                            <span class="original-number">{{ number_format(session('result.original_number'), 2) }}</span>
                                            <i class="fas fa-arrow-right mx-3 text-primary"></i>
                                            <div class="converted-text">
                                                {{ session('result.converted_text') }}
                                                <small class="text-muted d-block mt-2">
                                                    {{ session('result.conversion_type') === 'words' ? 'En palabras' : 'En dólares' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                                    <div>
                                        <h4 class="alert-heading mb-1">Error en la Conversión</h4>
                                        <p class="mb-2">{{ session('result.error') }}</p>
                                        @if(session('result.fallback_result'))
                                            <div class="mt-3">
                                                <h6 class="mb-2"><i class="fas fa-info-circle me-1"></i> Resultado aproximado (fuera de línea):</h6>
                                                <div class="fallback-result bg-light p-3 rounded">
                                                    {{ session('result.fallback_result') }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="converter-form" method="POST" action="{{ route('number.convert') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" step="0.01" min="0" class="form-control"
                                           id="number" name="number" value="{{ old('number', 1) }}"
                                           placeholder="Ej. 123.45" required>
                                    <label for="number">Número a Convertir</label>
                                    <div class="invalid-feedback">
                                        Por favor ingrese un número válido
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="conversion_type" name="conversion_type" required>
                                        <option value="">Seleccione tipo</option>
                                        <option value="words" {{ old('conversion_type') == 'words' ? 'selected' : '' }}>A palabras</option>
                                        <option value="dollars" {{ old('conversion_type') == 'dollars' ? 'selected' : '' }}>A dólares</option>
                                    </select>
                                    <label for="conversion_type">Tipo de Conversión</label>
                                    <div class="invalid-feedback">
                                        Por favor seleccione un tipo de conversión
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-exchange-alt me-2"></i> Convertir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if(session('result.success') && session('result.converted_text'))
                        <div class="mt-5 pt-4 border-top">
                            <div class="text-center">
                                <button id="new-conversion" class="btn btn-outline-secondary">
                                    <i class="fas fa-sync-alt me-2"></i> Nueva Conversión
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
    }

    .original-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .converted-text {
        font-size: 1.2rem;
        line-height: 1.6;
    }

    .conversion-result {
        background: rgba(78, 84, 200, 0.1);
        padding: 1rem;
        border-radius: 0.5rem;
        display: inline-flex;
        align-items: center;
    }

    .fallback-result {
        border-left: 4px solid #f39c12;
    }

    .number-animation {
        font-size: 1.5rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Validación de formulario
        (function() {
            'use strict';
            var form = document.getElementById('converter-form');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();

        // Nueva conversión
        $('#new-conversion').click(function() {
            $('html, body').animate({
                scrollTop: $('#converter-form').offset().top - 100
            }, 500);
        });

        // Mostrar errores con SweetAlert
        @if(session('result.error'))
            Swal.fire({
                icon: 'error',
                title: 'Error en la conversión',
                text: '{{ session('result.error') }}',
                confirmButtonColor: '#4e54c8'
            });
        @endif
    });
</script>
@endpush    