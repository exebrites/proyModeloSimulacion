<<<<<<< HEAD
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Test de Rachas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    {{-- {{dd($rangosEvaluacionRachas)}} --}}
=======
@extends('layout.plantilla')

@section('title', 'Resultados del Test de Rachas')

@section('content')
>>>>>>> f147710d50a9d0783539651830d02820ce049e4d
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
                                <th>Rancha contada</th>
                                <th>Rango de prueba</th>
                                <th>Evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaulacionRachasUnos as $index => $resultado)
                                <tr>
                                    <td>Longitud {{ $index + 1 }}</td>
                                    <td>{{$longitudRachasUnos[$index]}}</td>
                                    <td>({{$rangosEvaluacionRachas[$index][0]}},{{ $rangosEvaluacionRachas[$index][1]}})</td>
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
                                <th>Rancha contada</th>
                                <th>Rango de prueba</th>
                                <th>Evaluación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evaulacionRachasCeros as $index => $resultado)
                                <tr>
                                    <td>Longitud {{ $index + 1 }}</td>
                                    <td>{{$longitudRachasCeros[$index]}}</td>
                                    <td>({{$rangosEvaluacionRachas[$index][0]}},{{ $rangosEvaluacionRachas[$index][1]}})</td>

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