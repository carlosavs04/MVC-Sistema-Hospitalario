<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Citas</title>
</head>
<x-navbar />
<body class="bg-sky-200">
    <h1 class="text-center text-3xl">Citas</h1>
    @if (session('status'))
    <div class="flex justify-center rounded-md">
        <div class="text-center bg-white px-32 shadow-md">
        {{ session('message') }}
        </div>
    </div>
    @endif
    <div class="flex justify-center">
        <table class="table-auto border-collapse border">
            <thead>
                <tr class="border border-collapse bg-slate-600 text-white text-center">
                    <th class="border">Paciente</th>
                    <th class="border">Fecha</th>
                    <th class="border">Hora</th>
                    <th class="border">Estatus</th>
                    <th class="border">Motivo</th>
                    <th class="border px-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $appointment)
                    <tr class="border border-collapse bg-white text-center">
                        <td class="border">{{ $appointment->patient }} </td>
                        <td class="border">{{ $appointment->date }}</td>
                        <td class="border">{{ $appointment->time }}</td>
                        <td class="border">{{ $appointment->status }}</td>
                        <td class="border">{{ $appointment->reason }}</td>
                        <td class="border">
                        <button class="bg-blue-500 rounded-sm px-2 text-white">
                        <i class="bi bi-pencil-square"
                        data-bs-target="#modal-{{ $appointment->id }}"
                        data-bs-toggle="modal"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>