<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Proyecto Números Aleatorios</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">🧮 Números Aleatorios</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#como-funciona">¿Cómo funciona?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fibonacci">Fibonacci</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#metodo-mixto-de-congruencias">Método Mixto de Congruencias</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        <div class="container text-center">
            <h1 class="mb-4">Proyecto de Modelo y Simulación</h1>
            <p class="lead">Exploración de algoritmos para la generación de números aleatorios</p>

            <section class="mt-5" id="como-funciona">
                <h2>¿Como funciona?</h2>   
                <p>
                    En este proyecto, hemos desarrollado dos algoritmos para la generación de números aleatorios: 
                    el algoritmo de Fibonacci y el algoritmo mixto de congruencias. 
                    Estos algoritmos son fundamentales en la generación de números aleatorios y son utilizados en diversas aplicaciones y sistemas.
                </p>
            </section>

            <section class="mt-5" id="fibonacci">   
                <h2>Fibonacci</h2>
                <p>
                    El algoritmo de Fibonacci es un enfoque matemático que se utiliza para generar secuencias de números aleatorios. 
                    La secuencia de Fibonacci se compone de los primeros dos números (0 y 1), y luego se generan los siguientes
                    números sumando los dos anteriores. 
                    Este algoritmo es popular debido a su eficiencia y su capacidad para generar secuencias de números aleatorios 
                    con una distribución uniforme.
                </p>
                <div>
                    <a href="{{ route('fibonacci') }}" class="btn btn-primary btn-lg w-100">Probar Fibonacci</a>
                </div>
            </section>

            <section class="mt-5" id="metodo-mixto-de-congruencias">
                <h2>Método Mixto de Congruencias</h2>
                <p>
                    El algoritmo mixto de congruencias es un enfoque matemático que se utiliza para generar secuencias de números aleatorios. 
                    En el algoritmo mixto de congruencias, se utilizan ecuaciones de congruencia para generar secuencias de números aleatorios. 
                    Este algoritmo es popular debido a su eficiencia y su capacidad para generar secuencias de números aleatorios 
                    con una distribución uniforme.
                </p>
                <div>
                    <a href="{{ route('congruencia') }}" class="btn btn-primary btn-lg w-100" style="background-color:cadetblue">Probar Metodo Mixto de Congruencias</a>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; 2025 Proyecto de Números Aleatorios | Grupo 3 | Lic. en Sistemas</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
