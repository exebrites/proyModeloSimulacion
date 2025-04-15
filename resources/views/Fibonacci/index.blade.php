<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci | Números Aleatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<style>
    body {
        background-color: whitesmoke;
    }
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
                        <form action="{{ route('metodoFibonacci') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="v1" class="form-label">Valor 1</label>
                                <input type="number" class="form-control" id="v1" name="v1" required>
                            </div>
                            <div class="mb-3">
                                <label for="v2" class="form-label">Valor 2</label>
                                <input type="number" class="form-control" id="v2" name="v2" required>
                            </div>
                            <div class="mb-3">
                                <label for="a" class="form-label">A (módulo)</label>
                                <input type="number" class="form-control" id="a" name="a" required>
                            </div>
                            <div class="mb-3">
                                <label for="n" class="form-label">N (cantidad de números)</label>
                                <input type="number" class="form-control" id="n" name="n" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Generar Secuencia</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <h4>Proyecto de Modelo y Simulación</h4>
                        <button class="btn btn-primary w-100" onclick="window.location.href='{{ route('home') }}'"> Volver al Inicio</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
