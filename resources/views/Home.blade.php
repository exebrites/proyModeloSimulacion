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
                <a class="navbar-brand fw-bold text-light" href="{{ route('numerosAleatorios') }}" >🧮 Números Aleatorios</a>
                <a class="navbar-brand fw-bold text-light" href="{{ route('distribuciones') }}">📊 Distribuciones</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>


    <main class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">

            </div>
        </div>
    </main>

@endsection
