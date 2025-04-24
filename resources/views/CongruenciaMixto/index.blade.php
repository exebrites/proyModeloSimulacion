<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congruencia Mixto | Números Aleatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body { background-color: whitesmoke; }
    .error-message { color: #dc3545; font-size: 0.875em; }
    .custom-error { color: #dc3545; }
</style>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Generador Congruencia Mixto</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h5 class="alert-heading">¡Error en los datos ingresados!</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    @if($errors->has('custom'))
                                        @foreach($errors->get('custom') as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('metodoCongruenciaMixto') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="a" class="form-label">Parámetro A</label>
                                <input type="number" class="form-control @error('a') is-invalid @enderror" 
                                       id="a" name="a" value="{{ old('a') }}" required>
                                @error('a')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Debe ser entero positivo, impar y no divisible por 3 o 5 (ej: 7, 11, 13, 17, 19, 21, etc.)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="c" class="form-label">Parámetro C</label>
                                <input type="number" class="form-control @error('c') is-invalid @enderror" 
                                       id="c" name="c" value="{{ old('c') }}" required>
                                @error('c')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Debe ser entero positivo impar y coprimo con M (ej: si M=1000, C podría ser 7, 11, 13, etc.)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="m" class="form-label">Módulo M</label>
                                <input type="number" class="form-control @error('m') is-invalid @enderror" 
                                       id="m" name="m" value="{{ old('m') }}" required>
                                @error('m')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Debe ser mayor que A y la semilla V1 (ej: 1000, 1024, etc.)</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="v1" class="form-label">Semilla (V1)</label>
                                <input type="number" class="form-control @error('v1') is-invalid @enderror" 
                                       id="v1" name="v1" value="{{ old('v1') }}" required>
                                @error('v1')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Entero positivo menor que M (ej: si M=1000, V1 podría ser 123, 456, etc.)</small>
                            </div>

                            <div class="mb-3">
                                <label for="n" class="form-label">Número de iteraciones</label>
                                <input type="number" class="form-control @error('n') is-invalid @enderror" 
                                       id="n" name="n" value="{{ old('n', 5) }}" required min="1" max="1000">
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