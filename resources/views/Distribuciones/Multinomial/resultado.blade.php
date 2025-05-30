@extends('layout.plantilla')

@section('title', 'Resultado Multinomial')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-0">Resultados Multinomial</h3>
                        <span class="badge bg-light text-dark fs-6">
                            Probabilidad: {{ number_format($probabilidadExacta * 100, 4) }}%
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">Distribución teórica vs observada</h5>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Categoría</th>
                                        <th>Prob. Teórica</th>
                                        <th>Frecuencia</th>
                                        <th>Prob. Observada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $index => $categoria)
                                    <tr>
                                        <td>{{ $categoria }}</td>
                                        <td>{{ number_format($probabilidades[$index] * 100, 2) }}%</td>
                                        <td>{{ $resultados[$index] }}</td>
                                        <td>{{ number_format(($resultados[$index] / $ensayos) * 100, 2) }}%</td>
                                    </tr>
                                    @endforeach
                                    <tr class="table-secondary">
                                        <td><strong>Total</strong></td>
                                        <td>{{ number_format(array_sum($probabilidades) * 100, 2) }}%</td>
                                        <td>{{ array_sum($resultados) }}</td>
                                        <td>100%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Gráfico Comparativo</h5>
                            <canvas id="comparisonChart" height="250"></canvas>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Detalles del Cálculo</h5>
                        <div class="alert alert-info">
                            <p><strong>Fórmula multinomial:</strong></p>
                            <p class="mb-1">P(X) = n! / (x₁! × x₂! × ... × xₖ!) × (p₁ˣ¹ × p₂ˣ² × ... × pₖˣᵏ)</p>
                            <p class="mb-0 mt-2">
                                <strong>Para este caso:</strong><br>
                                P(X) = {{ $ensayos }}! / (
                                @foreach($resultados as $r){{ $r }}! × @endforeach
                                ) × (
                                @foreach($probabilidades as $i => $p)
                                    ({{ $p }}<sup>{{ $resultados[$i] }}</sup>) × 
                                @endforeach
                                )
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer text-center">
                    <a href="{{ route('distribuciones.multinomial.index') }}" class="btn btn-primary">
                        <i class="fas fa-calculator"></i> Nuevo Cálculo
                    </a>
                    <a href="http://localhost:8000/distribuciones" class="btn btn-outline-secondary">Volver a
                            Distribuciones
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('comparisonChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($categorias),
        datasets: [
            {
                label: 'Teórico',
                data: @json(array_map(function($p) { return $p * 100; }, $probabilidades)),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            },
            {
                label: 'Observado',
                data: @json(array_map(function($r) use ($ensayos) { return ($r / $ensayos) * 100; }, $resultados)),
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Probabilidad (%)'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Comparación Teórico vs Observado'
            }
        }
    }
});
</script>
@endsection