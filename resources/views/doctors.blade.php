<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>Pacientes</title>
</head>
<body class="bg-sky-200">
    <x-navbar></x-navbar>
    <h1 class="text-center text-3xl my-4">Doctores</h1>
    <div class="flex justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="border px-6 py-3">Id</th>
                        <th scope="col" class="border px-6 py-3">Nombre</th>
                        <th scope="col" class="border px-6 py-3">Apellidos</th>
                        <th scope="col" class="border px-6 py-3">Género</th>
                        <th scope="col" class="border px-6 py-3">Fecha de nacimiento</th>
                        <th scope="col" class="border px-6 py-3">Especialidad</th>
                        <th scope="col" class="border px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                    <tr class="bg-white">
                        <td class="border px-6 py-4">{{ $doctor->id }} </td>
                        <td class="border px-6 py-4">{{ $doctor->name }}</td>
                        <td class="border px-6 py-4">{{ $doctor->last_name }}</td>
                        <td class="border px-6 py-4">{{ $doctor->gender }}</td>
                        <td class="border px-6 py-4">{{ $doctor->birth_date}}</td>
                        <td class="border px-6 py-4">{{ $doctor->specialty_name }}</td>
                        <td class="border px-6 py-4">
                            <button class="bg-blue-500 rounded-sm px-2 text-white">
                                <i class="bi bi-pencil-square"
                                    data-bs-target="#modal-{{ $doctor->id }}"
                                    data-bs-toggle="modal">
                                </i>
                            </button>
                            <a href="/deleteDoctor/{{ $doctor->id }}">
                                <button class="bg-red-600 rounded-sm px-2 text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </a>
                        </td>
                        <div class="modal fade" id="modal-{{ $doctor->id }}"
                            tabindex="-1"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <form action="/updateDoctor/{{ $doctor->id }}" method="POST">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Especialidad</h1>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        @method('POST')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="specialty_id" class="form-label">Especialidad</label><br>
                                            <select name="specialty_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                @foreach ($specialties as $specialty)
                                                @php
                                                    $selected = $doctor->specialty_id === $specialty->id
                                                    ? 'selected' : '' ;
                                                @endphp
                                                <option {{$selected}} value={{$specialty->id}}>
                                                    {{ $specialty->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"  data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
                                </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
