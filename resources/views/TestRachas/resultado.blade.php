<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultado del Test Rachas</title>
</head>
<body>
    <h1>Resultado del Test de Rachas</h1>
    {{-- Ver como mostramos --}}
    {{dd($evaulacionRachasUnos, $evaulacionRachasCeros);}}

    {{-- printf("EVALUACION RACHAS UNOS <br>");
    foreach ($evaulacionRachasUnos as $key => $evaluacion) {
        # code...
        if ($evaluacion) {

            printf("log %s: %s\n", $key + 1, "paso la evaluacion");
        } else {
            printf("log %s: %s\n", $key + 1, "no paso la evaluacion ");
        }
    }

    printf("<br>");
    printf("EVALUACION RACHAS CEROS <br>");
    foreach ($evaulacionRachasCeros as $key => $evaluacion) {
        # code...
        if ($evaluacion) {

            printf("log %s: %s\n", $key + 1, "paso la evaluacion");
        } else {
            printf("log %s: %s\n", $key + 1, "no paso la evaluacion");
        }
    } --}}
</body>
</html>