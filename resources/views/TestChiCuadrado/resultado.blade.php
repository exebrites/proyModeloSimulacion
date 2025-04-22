<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado Test Chi cuadrado</title>
</head>
<body>
    <h1>Resultado Test Chi cuadrado</h1>
    {{dd($chiCuadradoCalculado, $chiCuadradoCritico);}}
    {{-- Mostrar la evaluacion de la hipotesis nula y alternativa --}}
    {{-- si hace falta traer mas datos para visualizar el resultado --}}
    {{-- if ($chiCuadradoCalculado <= $chiCuadradoCritico) {
        # code...
        return 'aceptar hipotesis nula';
    } else {
        # code...
        return 'rechazar hipotesis nula';
    } --}}
</body>
</html>