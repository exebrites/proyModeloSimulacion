<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Valores de Sucesores</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sucesores as $key => $sucesor)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $sucesor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>