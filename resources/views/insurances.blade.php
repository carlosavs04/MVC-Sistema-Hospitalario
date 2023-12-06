<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/carrusel.css')
    <title>Aseguradoras</title>
</head>
<body class="bg-sky-200">
    <x-navbar/>
    <h1 class="text-center text-3xl mt-4">Aseguradoras</h1>
    @if (session('status'))
    <div class="flex justify-center rounded-md">
        <div class="text-center bg-white px-32 shadow-md">
        {{ session('message') }}
        </div>
    </div>
    @endif
    <div class="flex justify-center translate-x-60 translate-y-8">
    <button class="bg-blue-500 text-white px-2 py-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-plus-circle-fill"></i>Agregar
    </button>
    </div>
    <div class="flex justify-center">
        <table class="table-auto border-collapse border">
            <thead>
                <tr class="border border-collapse bg-slate-600 text-white text-center">
                    <th class="px-4 border">Id</th>
                    <th class="border">Nombre</th>
                    <th class="border px-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insurances as $insurance)
                    <tr class="border border-collapse bg-white text-center">
                        <td class="border">{{ $insurance->id }}</td>
                        <td class="border">{{ $insurance->name }}</td>
                        <td class="border">
                        <button class="bg-blue-500 rounded-sm px-2 text-white">
                        <i class="bi bi-pencil-square"
                        data-bs-target="#modal-{{ $insurance->id }}"
                        data-bs-toggle="modal"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal-{{ $insurance->id }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="/updateInsurance/{{ $insurance->id }}" method="POST">
                            @method('POST')
                            @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Aseguradora</h1>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $insurance->name }}">
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="/addInsurance" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Aseguradora</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @method('POST')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
