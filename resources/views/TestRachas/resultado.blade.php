@extends('layout.plantilla')

@section('title', 'Resultados del Test de Rachas')

@section('content')
    <div class="container py-5">
        <div class="col-lg-8 col-xl-6 mx-auto">
            <div class="card shadow rounded-4 overflow-hidden">

                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Resultado del Test de Rachas</h3>
                </div>

                <div class="card-body">
                    {{-- Evaluación de Rachas de Unos --}}
                    <h5 class="text-center mb-3">Evaluación de Rachas de <strong>Unos</strong></h5>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Longitud de Racha</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaulacionRachasUnos as $index => $resultado)
                                <tr>
                                    <td>Log {{ $index + 1 }}</td>
                                    <td class="{{ $resultado ? 'text-success' : 'text-danger' }}">
                                        {{ $resultado ? 'Pasó la evaluación' : 'No pasó la evaluación' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Evaluación de Rachas de Ceros --}}
                    <h5 class="text-center mt-4 mb-3">Evaluación de Rachas de <strong>Ceros</strong></h5>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Longitud de Racha</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaulacionRachasCeros as $index => $resultado)
                                <tr>
                                    <td>Log {{ $index + 1 }}</td>
                                    <td class="{{ $resultado ? 'text-success' : 'text-danger' }}">
                                        {{ $resultado ? 'Pasó la evaluación' : 'No pasó la evaluación' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-center bg-white border-top-0">
                    <a href="javascript:history.go(-2)" class="btn btn-outline-primary px-4 rounded-pill me-2">Volver a generar</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 rounded-pill">
                        <i class="bi bi-house-fill"></i> Inicio
                    </a>
                </div>
            </div>
        </div>   
    </div>
@endsection