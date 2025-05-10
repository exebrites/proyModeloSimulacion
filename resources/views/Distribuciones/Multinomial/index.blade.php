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
                            <input type="number" class="form-control" name="ensayos" required min="1" value="100">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Configurar categorías</label>
                            <div id="categorias-container">
                                <!-- Ejemplo inicial con 2 categorías -->
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="categorias[]" placeholder="Nombre (ej: Carne)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" step="0.01" class="form-control" name="probabilidades[]" placeholder="Probabilidad (ej: 0.5)" required min="0.01" max="0.99">
                                    </div>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="categorias[]" placeholder="Nombre (ej: Pescado)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" step="0.01" class="form-control" name="probabilidades[]" placeholder="Probabilidad (ej: 0.3)" required min="0.01" max="0.99">
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="agregar-categoria" class="btn btn-sm btn-success mt-2">+ Añadir categoría</button>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Generar Muestra</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('distribuciones') }}" class="btn btn-outline-primary">Volver a Distribuciones</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('agregar-categoria').addEventListener('click', function() {
        const container = document.getElementById('categorias-container');
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2';
        div.innerHTML = `
            <div class="col-md-6">
                <input type="text" class="form-control" name="categorias[]" placeholder="Nombre" required>
            </div>
            <div class="col-md-6">
                <input type="number" step="0.01" class="form-control" name="probabilidades[]" placeholder="Probabilidad" required min="0.01" max="0.99">
            </div>
        `;
        container.appendChild(div);
    });
</script>
@endsection