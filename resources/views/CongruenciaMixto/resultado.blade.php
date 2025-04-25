@extends('layout.plantilla')

@section('title', 'Resultados de Congruencia Mixto')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow rounded">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="mb-0">Valores Generados - Método Congruencia Mixto</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                    </div>
                    <?php $n = count($sucesores)?>
                
                    <div class="card-footer text-center bg-white">
                        <a href="{{route('rachas', $n)}}" class="btn btn-outline-primary rounded-pill px-4">Test de Rachas</a>
                        <a href="{{route('chi', $n)}}" class="btn btn-outline-primary rounded-pill px-4">Test de Chi Cuadrado</a>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('congruencia') }}" class="btn btn-primary">Volver al Generador</a>
                        <a href="{{ route('home') }}" class="btn btn-secondary ms-2">Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
