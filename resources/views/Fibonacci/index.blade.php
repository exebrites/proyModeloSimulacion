<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fibonacci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>


    <h1>Fibonacci</h1>

    <form action="{{ route('metodoFibonacci') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="v1" class="form-label">Valor 1</label>
            <input type="number" class="form-control" id="v1" name="v1" required>
        </div>
        <div class="mb-3">
            <label for="v2" class="form-label">Valor 2</label>
            <input type="number" class="form-control" id="v2" name="v2" required>
        </div>
        <div class="mb-3">
            <label for="a" class="form-label">A</label>
            <input type="number" class="form-control" id="a" name="a" required>
        </div>
        <div class="mb-3">
            <label for="n" class="form-label">N</label>
            <input type="number" class="form-control" id="n" name="n" required>
        </div>
        <button type="submit" class="btn btn-primary">Generar</button>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
