<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Aseguradoras</title>
</head>
<body class="bg-sky-200">
    <h1 class="text-center text-3xl">Aseguradoras</h1>
    <div class="flex justify-center translate-x-52 translate-y-8">
    <button class="bg-blue-500 text-white p-1 rounded-sm"><i class="bi bi-plus-circle-fill mx-2"></i>Agregar</button>
    </div>
    <div class="flex justify-center">
        <table class="table-auto border-collapse border">
            <thead>
                <tr class="border border-collapse bg-slate-600 text-white">
                    <th class="px-4 border">Id</th>
                    <th class="border">Nombre</th>
                    <th class="border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($insurances as $insurance)
                    <tr class="border border-collapse bg-white text-center">
                        <td class="border">{{ $insurance->id }}</td>
                        <td class="border">{{ $insurance->name }}</td>
                        <td class="border">
                        <button class="bg-blue-500 rounded-sm px-2 text-white">
                        <i class="bi bi-pencil-square"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
