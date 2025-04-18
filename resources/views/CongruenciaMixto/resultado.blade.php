<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado | Congruencia Mixto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body { background-color: whitesmoke; }
</style>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0">Valores Generados - Método Congruencia Mixto</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sucesores as $key => $sucesor)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $key + 1 }}</th>
                                        <td class="text-center">{{ $sucesor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('metodoCongruenciaMixto') }}" class="btn btn-primary">Volver al Generador</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary ms-2">Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
