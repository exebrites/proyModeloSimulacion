<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci | Números Aleatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body { background-color: whitesmoke; }
    .error-message { color: #dc3545; font-size: 0.875em; }
</style>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Generador de Fibonacci</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">¡Error en los datos ingresados!</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <form action="{{ route('metodoFibonacci') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="v1" class="form-label">Valor 1 (V1)</label>
                                <input type="number" class="form-control @error('v1') is-invalid @enderror" 
                                       id="v1" name="v1" value="{{ old('v1') }}" required>
                                @error('v1')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Entero no negativo de 3 a 7 dígitos</small>
                            </div>

                            <div class="mb-3">
                                <label for="v2" class="form-label">Valor 2 (V2)</label>
                                <input type="number" class="form-control @error('v2') is-invalid @enderror" 
                                       id="v2" name="v2" value="{{ old('v2') }}" required>
                                @error('v2')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Entero no negativo de 3 a 7 dígitos</small>
                            </div>

                            <div class="mb-3">
                                <label for="a" class="form-label">Parámetro A</label>
                                <input type="number" class="form-control @error('a') is-invalid @enderror" 
                                       id="a" name="a" value="{{ old('a') }}" required>
                                @error('a')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Debe ser mayor que V1 y V2 (3-7 dígitos)</small>
                            </div>

                            <div class="mb-3">
                                <label for="n" class="form-label">Número de iteraciones</label>
                                <input type="number" class="form-control @error('n') is-invalid @enderror" 
                                       id="n" name="n" value="{{ old('n', 5) }}" required>
                                @error('n')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Entre 1 y 1000 iteraciones</small>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Generar Secuencia</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <h5>Proyecto de Modelo y Simulación</h5>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-2">Volver al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>