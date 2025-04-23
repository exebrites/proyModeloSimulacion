</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Test Chi Cuadrado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="col-lg-8 col-xl-6 mx-auto">
            <div class="card shadow rounded-4 overflow-hidden">

                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Resultado del Test Chi Cuadrado</h3>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <p><strong>Chi Cuadrado Calculado:</strong> {{ number_format($chiCuadradoCalculado, 4) }}</p>
                        <p><strong>Chi Cuadrado Crítico (α = 0.05, gl = 9):</strong> {{ $chiCuadradoCritico }}</p>
                    </div>

                    {{-- Resultado de hipótesis --}}
                    @if ($chiCuadradoCalculado <= $chiCuadradoCritico)
                        <div class="alert alert-success text-center">
                            <strong>Resultado:</strong> Se <strong>acepta</strong> la hipótesis nula.<br> Los números parecen seguir una distribución uniforme.
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            <strong>Resultado:</strong> Se <strong>rechaza</strong> la hipótesis nula.<br> Los números no siguen una distribución uniforme.
                        </div>
                    @endif

                    {{-- Tabla de Frecuencias Observadas --}}
                    @if (isset($frecuenciaObservada))
                        <div class="mt-4">
                            <h5 class="text-center">Frecuencia Observada por Dígito (0–9)</h5>
                            <table class="table table-bordered table-hover mt-3 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Dígito</th>
                                        <th>Frecuencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($frecuenciaObservada as $digito => $frecuencia)
                                        <tr>
                                            <td>{{ $digito }}</td>
                                            <td>{{ $frecuencia }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <div class="card-footer text-center bg-white">
                    <!-- Volver a 2 url antertior-->
                    <a href="javascript:history.go(-2)" class="btn btn-outline-primary px-4 rounded-pill">Volver a generar</a>
                   </a>
                </div>
            </div>
        </div>   
    </div>
</body>
</html>
