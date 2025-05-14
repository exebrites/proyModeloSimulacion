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
                <a class="navbar-brand fw-bold text-light" href="{{ route('home') }}">🧮 Números Aleatorios</a>
                <a class="navbar-brand fw-bold text-light" href="{{ route('distribuciones') }}">📊 Distribuciones</a>
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
                <h1 class="mb-4">Proyecto de Modelo y Simulación</h1>
                <p class="lead mb-5">Distribuciones Probabilísticas</p>
                <p class="lead mb-5">Generación de muestras artificiales para modelos discretos y continuos</p>

                <section class="mt-5" id="como-funciona">
                    <h2 class="mb-3">¿Como funcionan las distribuciones?</h2>
                    <p class="mb-4">
                        Las distribuciones probabilísticas son funciones matemáticas que describen la probabilidad de
                        ocurrencia de diferentes resultados en un experimento aleatorio. Estas distribuciones pueden ser
                        discretas (como la binomial o multinomial) o continuas (como la normal).
                    </p>
                </section>

                <section class="mt-5" id="multinomial">
                    <h2 class="mb-3">Distribución Multinomial</h2>
                    <p class="mb-4">
                        Modelo para experimentos con <strong>múltiples categorías</strong> (ej: encuestas, tipos de
                        eventos).
                        Generaliza la distribución binomial para más de dos resultados posibles.
                    </p>
                    <div class="mb-4">
                        <a href="{{ route('distribuciones.multinomial.index') }}" class="btn btn-primary btn-lg w-100">Probar
                            Multinomial</a>
                    </div>
                </section>


                <section class="mt-5" id="normal">
                    <h2 class="mb-3">Distribución Normal</h2>
                    <p class="mb-4">
                        Modelo continuo para fenómenos naturales (ej: estaturas, errores de medición).
                        Basado en el Teorema del Límite Central.
                    </p>
                    <div class="mb-4">
                        <a href="{{ route('distribuciones.normal.index') }}" class="btn btn-primary btn-lg w-100">Probar Normal</a>
                    </div>
                </section>
            </div>
        </div>
    </main>

@endsection
