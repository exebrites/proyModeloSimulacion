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
                        <h5 class="mb-4">Distribución generada:</h5>
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Marca de clase (X)</th>
                                    <th>Límite X inferior</th>
                                    <th>Límite X superior</th>
                                    <th>Límite Z inferior</th>
                                    <th>Límite Z superior</th>
                                    <th>Marca de clase (Z)</th>
                                    <th>Probabilidad (Z)</th>
                                    <th>Acumulada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabla as $item)
                                    <tr>
                                        <td>{{ $item['clase'] }}</td>
                                        <td>{{ $item['valorX'] }}</td>
                                        <td>{{ $item['limInf'] }}</td>
                                        <td>{{ $item['limSup'] }}</td>
                                        <td>{{ $item['liZ'] }}</td>
                                        <td>{{ $item['lsZ'] }}</td>
                                        <td>{{ $item['marcaZ'] }}</td>
                                        <td>{{ $item['probZ'] }}</td>
                                        <td>{{ $item['acumulada'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Gráfico con Chart.js -->
                        {{-- <canvas id="multinomialChart" height="200"></canvas> --}}

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
        // Aquí va el código de la gráfica

        // Datos para la gráfica
        const etiquetas = [];
        const datos = [];

        // console.log("Tabla de datos:", @json($tabla));

        // Recorrer la tabla y extraer los datos
        @foreach ($tabla as $fila)
            //  console.log("Fila:", @json($fila['valorX']));

            etiquetas.push(@json($fila['clase']));
            datos.push(@json($fila['probZ']));
        @endforeach

        console.log("Etiquetas:", etiquetas);
        console.log("Datos:", datos);

        // Crear la gráfica
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: 'Probabilidad',
                    data: datos,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1,
                    fill: true,
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderWidth: 3,
                    borderColor: 'rgba(0, 0, 0, 1)',
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',

                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
