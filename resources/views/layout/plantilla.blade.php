<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<style>
    body {    
        background-color: rgb(29, 16, 167);
        background-image: radial-gradient(circle at 50% 0%, hsla(319, 0%, 0%, 1) 49.15975941515135%, transparent 102.23193813062571%);
        background-blend-mode: normal;
        
        color: beige;
    }

    .error-message { color: #dc3545; font-size: 0.875em; }

    .success-message { color: #28a745; font-size: 0.875em; }

    .custom-error { color: #dc3545; }

    .custom-footer {
        background-color: transparent;
        color: beige;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Agregar estilos para hacer que el contenido se adapte */
    #conten {
        min-height: 100vh; /* Ocupa todo el alto de la pantalla */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

<body>
    <div id="conten" class="container-fluid d-flex flex-column">
        @yield('content')
        
        <footer class="text-center py-3 mt-auto custom-footer">
            <p class="mb-0">&copy; 2025 Proyecto de Números Aleatorios | Grupo 3 | Lic. en Sistemas</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>