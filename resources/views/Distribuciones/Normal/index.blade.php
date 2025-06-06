@extends('layout.plantilla')

@section('title', 'Proyecto de Modelo y Simulación')

@section('content')
    <style>
        .custom-header {
            background-color: transparent;
        }

        .custom-navbar {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            border-radius: 1rem;
            padding: 0.75rem 1rem;
        }

        .custom-navbar .nav-link {
            color: #e0e0e0;
            transition: color 0.2s ease-in-out;
        }

        .custom-navbar .nav-link:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .custom-navbar .navbar-brand {
            color: #ffffff;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-header bg-primary text-white text-center">
                            <h3 class="mb-4">Datos a Ingresar para la Distribución Normal</h3>
                    </div>
                    <div class="card-body">      
                        <form action="{{ route('distribuciones.normal.calcular') }}" method="POST">
                            @csrf
                            <h3 class="mb-3">Parametros del conjunto de datos:</h3>
                            <div class="mb-3">
                                <label for="media" class="form-label">Media (μ)</label>
                                <input type="number" class="form-control @error('media') is-invalid @enderror" id="media" name="media"
                                    value="{{ old('media') }}" required step="0.01">
                                @error('media')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="desviacion_estandar" class="form-label">Desviación estándar (σ)</label>
                                <input type="number" class="form-control @error('desviacion_estandar') is-invalid @enderror"
                                    id="desviacion_estandar" name="desviacion_estandar" value="{{ old('desviacion_estandar') }}" required
                                    step="0.01">
                                @error('desviacion_estandar')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <h3 class="mb-3">Ingrese los valores del conjunto de datos:</h3>
                            <div id="dynamicForm">
                                <div class="mb-3">
                                    <label for="number0" class="form-label">Valor 1</label>
                                    <input type="number" class="form-control" id="number0" name="number[]">
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" onclick="addField()">Agregar valor</button>
                            <button type="button" class="btn btn-danger" onclick="removeField()">Quitar valor</button>



                            <br>
                            <br>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Generar distribución</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
                Funciones para agregar y quitar campos dinamicamente para introducir
                los valores de la distribución normal.
            -->
    <script>
        let fieldCount = 1;

        function addField() {
            const form = document.getElementById('dynamicForm');
            const newField = document.createElement('div');
            newField.classList.add('mb-3');
            newField.innerHTML = `
            <label for="number${fieldCount}" class="form-label">Valor ${fieldCount + 1}</label>
            <input type="number" class="form-control" id="number${fieldCount}" name="number[]">
        `;
            form.appendChild(newField);
            fieldCount++;
        }

        function removeField() {
            if (fieldCount > 1) {
                const form = document.getElementById('dynamicForm');
                form.removeChild(form.lastElementChild);
                fieldCount--;
            }
        }
    </script>

@endsection
