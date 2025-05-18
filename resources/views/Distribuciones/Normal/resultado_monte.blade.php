@extends('layout.plantilla')

@section('title', 'Resultado Normal')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Resultados Normal</h3>
                    </div>
                    <div class="card-body">
                        <p>Media: {{ $media }}</p>
                        <p>Desviación Estándar: {{ $desviacionEstandar }}</p>
                        <p>Números de Marca de Clases: {{ $numeroMarcasClases }}</p>
                        <p>Porcentaje de Valores Extremos: {{ $porcentajeValoresExtremos * 100 }}%</p>

                        <p>Valores Extremos: [{{ $valoresExtremos['inferior'] }}, {{ $valoresExtremos['superior'] }}]</p>

                        <hr>
                        <h4 class="mb-3">Marcas de Clases</h4>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>N° Marca de Clase</th>
                                    <th>Límite Inferior</th>
                                    <th>Límite Superior</th>
                                    <th>Marca de Clase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $marca)
                                    <tr>
                                        <td>{{ $marca['numero_marca_clase'] }}</td>
                                        <td>{{ $marca['limite_inferior'] }}</td>
                                        <td>{{ $marca['limite_superior'] }}</td>
                                        <td>{{ $marca['marca_clase'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <h4 class="mb-3">Muestras Artificiales</h4>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Nros aleatorios</th>
                                    {{-- <th>Z (aprox.)</th> --}}
                                    <th>Convertir Z a X</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($muestras as $muestra)
                                    <tr>
                                        <td>{{ $muestra['numero'] }}</td>
                                        <td>{{ $muestra['z'] }}</td>
                                        {{-- <td>{{ $muestra['x'] }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="mb-3">Clasificación de Muestras en forma tabular</h4>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>N° Marca de Clase</th>
                                    <th>Clasificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clasificacion as $item)
                                    <tr>
                                        <td>{{ $item['marca'] }}</td>
                                        <td>{{ $item['cantidad'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="mb-3">Clasificación de Muestras en forma gráfica</h4>
                        <canvas id="myChart" width="400" height="200"></canvas>

                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('distribuciones.multinomial.index') }}" class="btn btn-primary">Nuevo Cálculo</a>
                        <a href="{{ route('distribuciones') }}" class="btn btn-outline-secondary">Volver a
                            Distribuciones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <script>
        // Datos para la gráfica
        const etiquetas = [];
        const datos = [];

        // Recorrer la clasificación y extraer los datos
        @foreach ($clasificacion as $item)
            etiquetas.push(@json($item['marca']));
            datos.push(@json($item['cantidad']));
        @endforeach

        console.log("Etiquetas:", etiquetas);
        console.log("Datos:", datos);

        // Crear la gráfica
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: 'Cantidad',
                    data: datos,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Marcas de Clases'
                        }
                    }]
                }
            }
        });
    </script>
@endsection
