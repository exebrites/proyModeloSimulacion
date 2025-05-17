@extends('layout.plantilla')

@section('title', 'Fibonacci - Ver secuencia')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Secuencia de Fibonacci</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Valor 1:</strong> {{ $semilla->v1 }}</li>
                        <li class="list-group-item"><strong>Valor 2:</strong> {{ $semilla->v2 }}</li>
                        <li class="list-group-item"><strong>Número de iteraciones (n):</strong> {{ $semilla->n }}</li>
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
                            @foreach ($numeros as $key => $numero)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $numero->resultado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="{{ route('fibonacci') }}" class="btn btn-primary">Volver a Fibonacci</a>
                </div>
            </div>
        </div>
    </div>

@endsection
