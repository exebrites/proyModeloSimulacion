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

        /* Estilos para la tabla */
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: rgba(161, 154, 154, 0.3);
            backdrop-filter: blur(4px);
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
        }

        .modern-table thead {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modern-table th {
            color: #ffffff;
            padding: 1rem;
            text-align: center;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .modern-table td {
            color: #e0e0e0;
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background-color 0.2s ease;
        }

        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }

        .modern-table tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.05);
        }

        /* Estilos para los botones de acción */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: #e0e0e0;
            border: none;
            border-radius: 0.5rem;
            margin: 0 0.25rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .action-btn i {
            margin-right: 0.5rem;
        }


    </style>
    <header class="custom-header py-2 mb-4">
        <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-light" href="{{ route('home') }}">🏠 Inicio</a>
                <a class="navbar-brand fw-bold text-light" href="{{ route('integrador.index') }}">🎲 Integrador</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#como-funciona">¿Cómo funciona?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#multinomial">Distribución Multinomial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#normal">Distribución Normal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main class="py-3">
        <div class="container py-1">
            <div class="row justify-content-center">
                <h1 class="mb-2">Gestión de Stock</h1>
                <p class="mb-4">
                    Este sección permite registrar y gestionar el stock de productos.
                </p>

                <section class="mt-2" id="multinomial">
                    <div class="mb-4 d-flex justify-content-end">
                        <a href="{{ route('integrador.stock.create') }}" class="btn btn-primary btn-lg">Registrar Ingreso</a>
                    </div>
                    <!-- Reemplaza tu tabla actual por esta versión mejorada -->
                    <table class="modern-table ">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stocks as $stock)
                                <tr>
                                    <td>{{ $stock->producto }}</td>
                                    <td>{{ $stock->cantidad_actual }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="action-btn">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="#" class="action-btn">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

            </div>
        </div>
    </main>

@endsection
