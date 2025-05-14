@extends('layout.plantilla')

@section('title', 'Proyecto de Modelo y Simulación')

@section('content')
    <style>
        .custom-header {
            background-color: transparent;
        }

        .custom-navbar {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            border-radius: 1rem;
            padding: 0.75rem 1rem;
        }

        .custom-navbar .nav-link {
            color: #e0e0e0;
            transition: color 0.2s ease-in-out;
        }

        .custom-navbar .nav-link:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .custom-navbar .navbar-brand {
            color: #ffffff;
        }
    </style>
<form action="{{ route('distribuciones.normal.calcular') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="media" class="form-label">Media (μ)</label>
        <input type="number" class="form-control @error('media') is-invalid @enderror" 
            id="media" name="media" value="{{ old('media') }}" required step="0.01">
        @error('media')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="desviacion_estandar" class="form-label">Desviación estándar (σ)</label>
        <input type="number" class="form-control @error('desviacion_estandar') is-invalid @enderror" 
            id="desviacion_estandar" name="desviacion_estandar" value="{{ old('desviacion_estandar') }}" required step="0.01">
        @error('desviacion_estandar')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Generar distribución</button>
</form>
@endsection
