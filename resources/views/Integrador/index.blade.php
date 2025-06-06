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
    <header class="custom-header py-3 mb-4">
        <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-light" href="{{ route('home') }}">🏠 Inicio</a>
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


    <main class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <h1 class="mb-4">Integrador de Modelo y Simulación</h1>
                <p class="lead mb-5">Modelo de Existencias</p>
                <p class="lead mb-5"></p>

                <section class="mt-5" id="como-funciona">
                    <h2 class="mb-3">Escenario propuesto</h2>
                    <!--Modal donde pueda agregar la descripción del Escenario-->


                </section>

                <section class="mt-5" id="multinomial">
                    <h2 class="mb-3 text-center">Acciones</h2>
                    <div class="mb-4">
                        <a href="{{ route('integrador.stock.index') }}" class="btn btn-primary btn-lg w-100">Stock</a>
                    </div>
                </section>


                <section class="mt-5" id="normal">
                    <h2 class="mb-3">Distribución Normal</h2>
                    <p class="mb-4">
                        Modelo continuo para fenómenos naturales (ej: estaturas, errores de medición).
                        Basado en el Teorema del Límite Central.
                    </p>
                    <div class="mb-4">
                        <a href="{{ route('distribuciones.normal.index') }}" class="btn btn-primary btn-lg w-100">Probar Normal con datos</a>
                    
        
                    </div>

                    <div class="mb-4">
                        <a href="{{ route('montecarlo') }}" class="btn btn-primary btn-lg w-100">Probar Normal con generar de numeros</a>
                    </div>
                </section>
            </div>
        </div>
    </main>

@endsection
