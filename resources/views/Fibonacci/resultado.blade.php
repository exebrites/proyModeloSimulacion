@extends('layout.plantilla')

@section('title', 'Resultados de Fibonacci')

@section('content')

{{-- {{dd($semilla,$numeros);}} --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Resultados del Método Fibonacci</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Valor 1:</strong> {{ $lastFiveValues[0]->resultado }}</li>
                        <li class="list-group-item"><strong>Valor 2:</strong> {{ $lastFiveValues[1]->resultado }}</li>
                        <li class="list-group-item"><strong>Parámetro de control (a):</strong> {{ $a }}</li>
                        <li class="list-group-item"><strong>Número de iteraciones (n):</strong> {{ $n }}</li>
                    </ul>

                    <h5 class="text-center">Últimos valores generados</h5>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lastFiveValues as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $value->resultado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <?php $n = count($lastFiveValues)?>
                <div class="card-footer text-center bg-white">
                    <a href="{{route('rachas', $n)}}" class="btn btn-outline-primary rounded-pill px-4">Test de Rachas</a>
                    <a href="{{route('chi', $n)}}" class="btn btn-outline-primary rounded-pill px-4">Test de Chi Cuadrado</a>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('fibonacci') }}" class="btn btn-primary">Volver a generar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>

@endsection