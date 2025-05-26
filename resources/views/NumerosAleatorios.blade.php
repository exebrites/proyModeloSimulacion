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
                            <a class="nav-link text-light" href="#fibonacci">Fibonacci</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#metodo-mixto-de-congruencias">Método Mixto de
                                Congruencias</a>
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
                <p class="lead mb-5">Exploración de algoritmos para la generación de números aleatorios</p>

                <section class="mt-5" id="como-funciona">
                    <h2 class="mb-3">¿Como funciona?</h2>
                    <p class="mb-4">
                        En este proyecto, hemos desarrollado dos algoritmos para la generación de números aleatorios:
                        el algoritmo de Fibonacci y el algoritmo mixto de congruencias.
                        Estos algoritmos son fundamentales en la generación de números aleatorios y son utilizados en
                        diversas aplicaciones y sistemas.
                    </p>
                </section>

                <section class="mt-5" id="fibonacci">
                    <h2 class="mb-3">Fibonacci</h2>
                    <p class="mb-4">
                        El algoritmo de Fibonacci es un enfoque matemático que se utiliza para generar secuencias de números
                        aleatorios.
                        La secuencia de Fibonacci se compone de los primeros dos números (0 y 1), y luego se generan los
                        siguientes
                        números sumando los dos anteriores.
                        Este algoritmo es popular debido a su eficiencia y su capacidad para generar secuencias de números
                        aleatorios
                        con una distribución uniforme.
                    </p>
                    <div class="mb-4">
                        <a href="{{ route('fibonacci') }}" class="btn btn-primary btn-lg w-100">Probar Fibonacci</a>
                    </div>
                </section>

                <section class="mt-5" id="metodo-mixto-de-congruencias">
                    <h2 class="mb-3">Método Mixto de Congruencias</h2>
                    <p class="mb-4">
                        El algoritmo mixto de congruencias es un enfoque matemático que se utiliza para generar secuencias
                        de números aleatorios.
                        En el algoritmo mixto de congruencias, se utilizan ecuaciones de congruencia para generar secuencias
                        de números aleatorios.
                        Este algoritmo es popular debido a su eficiencia y su capacidad para generar secuencias de números
                        aleatorios
                        con una distribución uniforme.
                    </p>
                    <div class="mb-4">
                        <a href="{{ route('congruencia') }}" class="btn btn-primary btn-lg w-100">Probar Metodo Mixto de
                            Congruencias</a>
                    </div>
                </section>
            </div>
        </div>
    </main>

@endsection
