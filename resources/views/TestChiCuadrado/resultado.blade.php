@extends('layout.plantilla')

@section('title', 'Resultados del Test de Chi Cuadrado')

@section('content')
    <div class="container py-5">
        <div class="col-lg-8 col-xl-6 mx-auto">
            <div class="card shadow rounded-4 overflow-hidden">

                <div class="card-header bg-success text-white text-center">
                    <h3 class="mb-0">Resultado del Test Chi Cuadrado</h3>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8">
                            <p><b>Valores para calcular Chi Cuadrado</b></p>
                            <p class="mb-2"><strong>n:</strong>{{ $valoresAuxiliares['n'] }} | <strong>k:</strong>
                                {{ $valoresAuxiliares['k'] }}| <strong>npi:</strong>{{ $valoresAuxiliares['npi'] }}|
                                <strong>gl:</strong>{{ $valoresAuxiliares['gl'] }}
                                <strong>α = 0.1</strong>
                            </p>
                            {{-- <p class="mb-2"><strong>Chi Cuadrado Crítico (α = 0.1, gl = 9):</strong> {{ $chiCuadradoCritico }}</p> --}}
                        </div>
                    </div>
                    <hr>
                    {{-- Tabla de Frecuencias Observadas --}}
                    @if (isset($frecuenciaObservada))
                        {{-- <h5 class="text-center mb-3">Frecuencia Observada por Dígito (0–9)</h5> --}}
                        <h5 class="text-center mb-3">Sistematización del calculo de chi cuadrado</h5>
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Dígito</th>
                                    <th>Frecuencia Observada</th>
                                    <th>Frecuencia Esperada</th>
                                    <th>Chi cuadrado - fila</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($frecuenciaObservada as $digito => $frecuencia)
                                    <tr>
                                        <td>{{ $digito }}</td>
                                        <td>{{ $frecuencia }}</td>
                                        <td>{{ $valoresAuxiliares['npi'] }}</td>
                                        <td>{{ $chicuadradoFila[$digito] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <hr>
                <div class="row justify-content-center mb-4">
                    
                    <h5 class="text-center mb">Contraste de hipotesis</h5>
<br><br>
                    <div class="col-md-8">
                        <p><strong>Hipótesis Nula (H<sub>0</sub>):</strong> Los números siguen una distribución uniforme.</p>
                        <p><strong>Hipótesis Alternativa (H<sub>1</sub>):</strong> Los números no siguen una distribución uniforme.</p>
                        <p class="mb-2"><strong>Chi Cuadrado Calculado:</strong>
                            {{ number_format($chiCuadradoCalculado, 4) }}</p>
                        <p class="mb-2"><strong>Chi Cuadrado Crítico (α = 0.1, gl = 9):</strong>
                            {{ $chiCuadradoCritico }}</p>
                    </div>
                </div>

                {{-- Resultado de hipótesis --}}
                <div class="text-center mb-4">
                    @if ($chiCuadradoCalculado <= $chiCuadradoCritico)
                        <div class="alert alert-success">
                            <strong>Resultado:</strong> Se <strong>acepta</strong> la hipótesis nula.<br> Los números
                            parecen seguir una distribución uniforme.
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <strong>Resultado:</strong> Se <strong>rechaza</strong> la hipótesis nula.<br> Los números
                            no siguen una distribución uniforme.
                        </div>
                    @endif
                </div>

                <div class="card-footer text-center bg-white border-top-0">
                    <a href="javascript:history.go(-2)" class="btn btn-outline-primary px-4 rounded-pill me-2">Volver a
                        generar</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-primary px-4 rounded-pill">
                        <i class="bi bi-house-fill"></i> Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
