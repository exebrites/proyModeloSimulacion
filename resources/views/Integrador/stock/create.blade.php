@extends('layout.plantilla')

@section('title', 'Registrar Ingreso de Stock')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow rounded" style="background-color: rgba(0, 0, 0, 0.3); backdrop-filter: blur(4px);">
                    <div class="card-header text-white text-center" style="background-color: rgba(0, 0, 0, 0.5);">
                        <h3 class="mb-0">Registrar ingreso de stock</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('integrador.stock.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="producto" class="form-label text-white">Producto</label>
                                <input type="text" class="form-control" id="producto" name="producto"
                                    style="background-color: rgba(255, 255, 255, 0.1); color: white; border: 1px solid rgba(255, 255, 255, 0.1);"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="cantidad" class="form-label text-white">Cantidad</label>
                                <input type="number" step="0.01" class="form-control" id="cantidad"
                                    name="cantidad_actual"
                                    style="background-color: rgba(255, 255, 255, 0.1); color: white; border: 1px solid rgba(255, 255, 255, 0.1);"
                                    required>
                            </div>

                            <!-- Botón regresar -->
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="{{ route('integrador.stock.index') }}" class="btn btn-primary w-100"
                                    style="background-color: rgba(228, 90, 10, 0.8); border: none;">
                                    Regresar
                                </a>
                                <span style="width: 10px;"></span> <!-- Espacio entre los botones -->
                                <button type="submit" class="btn btn-primary w-100"
                                    style="background-color: rgba(0, 123, 255, 0.8); border: none;">
                                    Registrar Ingreso
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
