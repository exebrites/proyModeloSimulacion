<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <form action="{{ route('metodoCongruenciaMixto') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="a" class="form-label">A</label>
            <input type="number" class="form-control" id="a" name="a" required>
            @error('a')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="c" class="form-label">C</label>
            <input type="number" class="form-control" id="c" name="c" required>
            @error('c')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="m" class="form-label">M</label>
            <input type="number" class="form-control" id="m" name="m" required>
            @error('m')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="n" class="form-label">N</label>
            <input type="number" class="form-control" id="n" name="n" required>
            @error('n')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        <div class="mb-3">
            <label for="v1" class="form-label">V1</label>
            <input type="number" class="form-control" id="v1" name="v1" required>
            @error('v1')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Generar Secuencia</button>
    </form>
</body>
</html>