@extends('layout.plantilla')

@section('title', 'Fibonacci')

@section('content')
{{-- {{dd($semillas[0]->numeros);}} --}}

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Generador de Fibonacci</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            El algoritmo de Fibonacci es un enfoque matemático que se utiliza para generar secuencias de números
                            aleatorios.
                            La secuencia de Fibonacci se compone de los primeros dos números (0 y 1), y luego se generan los
                            siguientes
                            números sumando los dos anteriores.
                            Este algoritmo es popular debido a su eficiencia y su capacidad para generar secuencias de números
                            aleatorios
                            con una distribución uniforme.
                        </p>
                        <table class="table table-bordered table-hover text-center mt-4">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Semilla</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semillas as $index => $semilla)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            v1: {{ $semilla->v1 }} <br>
                                            v2: {{ $semilla->v2 }} <br>
                                            m: {{ $semilla->m }}
                                        </td>
                                        <td>
                                            <a href="{{ route('fibonacci.show', $semilla->id) }}">Ver secuencia</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            <a href="{{ route('fibonacci.create') }}" class="btn btn-primary">Generar secuencia</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
