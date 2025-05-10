@extends('layout.plantilla')

@section('title', 'Resultado Multinomial')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Resultados Multinomial</h3>
                </div>
                <div class="card-body">
                    <h5 class="mb-4">Distribución generada:</h5>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Categoría</th>
                                <th>Probabilidad Teórica</th>
                                <th>Frecuencia Generada</th>
                                <th>Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $index => $categoria)
                                <tr>
                                    <td>{{ $categoria }}</td>
                                    <td>{{ number_format($probabilidades[$index] * 100, 2) }}%</td>
                                    <td>{{ $resultados[$index] }}</td>
                                    <td>{{ number_format($resultados[$index] / array_sum($resultados) * 100, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Gráfico con Chart.js -->
                    <canvas id="multinomialChart" height="200"></canvas>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('distribuciones.multinomial.index') }}" class="btn btn-primary">Nuevo Cálculo</a>
                    <a href="{{ route('distribuciones') }}" class="btn btn-outline-secondary">Volver a Distribuciones</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('multinomialChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($categorias),
            datasets: [{
                label: 'Frecuencia generada',
                data: @json($resultados),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                ],
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection