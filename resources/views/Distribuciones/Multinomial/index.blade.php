@extends('layout.plantilla')

@section('title', 'Multinomial')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Generador Multinomial</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('distribuciones.multinomial.calcular') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="ensayos" class="form-label">Número de ensayos (n)</label>
                                <input type="number" class="form-control" name="ensayos" required min="1"
                                    value="{{ old('ensayos', 10) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Configurar categorías</label>
                                <div id="categorias-container">
                                    @php
                                        $oldCats = old('categorias', ['Carne', 'Pescado', 'Vegetariano']);
                                        $oldProbs = old('probabilidades', [0.5, 0.3, 0.2]);
                                        $oldFreqs = old('frecuencias', [5, 3, 2]);
                                    @endphp

                                    @foreach ($oldCats as $index => $cat)
                                        <div class="row g-2 mb-2 categoria-group">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="categorias[]"
                                                    value="{{ $cat }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" step="0.01" class="form-control"
                                                    name="probabilidades[]" required min="0.01" max="0.99"
                                                    value="{{ $oldProbs[$index] }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="number" class="form-control frecuencia-input"
                                                    name="frecuencias[]" required min="0" step="1"
                                                    value="{{ $oldFreqs[$index] }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-between mt-2">
                                    <button type="button" id="agregar-categoria" class="btn btn-sm btn-success">
                                        + Añadir categoría
                                    </button>
                                    <small id="suma-probabilidades" class="text-muted">
                                        Suma probabilidades: {{ array_sum($oldProbs) }}
                                    </small>
                                    <small id="suma-frecuencias" class="text-muted">
                                        Suma frecuencias: {{ array_sum($oldFreqs) }}
                                    </small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Calcular Probabilidad</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Añadir categoría
            document.getElementById('agregar-categoria').addEventListener('click', function() {
                const container = document.getElementById('categorias-container');
                const index = document.querySelectorAll('.categoria-group').length;

                const div = document.createElement('div');
                div.className = 'row g-2 mb-2 categoria-group';
                div.innerHTML = `
            <div class="col-md-4">
                <input type="text" class="form-control" name="categorias[]" required>
            </div>
            <div class="col-md-4">
                <input type="number" step="0.01" class="form-control probabilidad-input" 
                       name="probabilidades[]" required min="0.01" max="0.99" value="0.2">
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control frecuencia-input" 
                       name="frecuencias[]" required min="0" value="0">
            </div>
        `;
                container.appendChild(div);
                actualizarSumas();
            });

            // Actualizar sumas de probabilidades y frecuencias
            function actualizarSumas() {
                // Suma probabilidades
                const inputsProb = document.querySelectorAll('input[name="probabilidades[]"]');
                let sumaProb = 0;
                inputsProb.forEach(input => {
                    sumaProb += parseFloat(input.value) || 0;
                });
                document.getElementById('suma-probabilidades').textContent = 'Suma probabilidades: ' + sumaProb
                    .toFixed(2);

                // Suma frecuencias
                const inputsFreq = document.querySelectorAll('input[name="frecuencias[]"]');
                let sumaFreq = 0;
                inputsFreq.forEach(input => {
                    sumaFreq += parseInt(input.value) || 0;
                });
                document.getElementById('suma-frecuencias').textContent = 'Suma frecuencias: ' + sumaFreq;
            }

            // Escuchar cambios en inputs
            document.addEventListener('input', function(e) {
                if (e.target.matches('.probabilidad-input, .frecuencia-input')) {
                    actualizarSumas();
                }
            });
        });
    </script>
@endsection
