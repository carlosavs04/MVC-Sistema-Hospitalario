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
    <title>Citas</title>
</head>

<body class="bg-sky-200">
    <x-navbar />
    <h1 class="text-center text-3xl">Mis citas</h1>
    @if (session('status'))
    <div class="flex justify-center rounded-md">
        <div class="text-center bg-white px-32 shadow-md">
            {{ session('message') }}
        </div>
    </div>
    @endif
    <div class="flex justify-center">



        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="border px-6 py-3">Doctor</th>
                        <th scope="col" class="border px-6 py-3">Área</th>
                        <th scope="col" class="border px-6 py-3">Fecha</th>
                        <th scope="col" class="border px-6 py-3">Hora</th>
                        <th scope="col" class="border px-6 py-3">Estatus</th>
                        <th scope="col" class="border px-6 py-3">Motivo</th>
                        <th scope="col" class="border px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr class="bg-white">
                        <td class="border px-6 py-4">{{ $appointment->doctor }} </td>
                        <td class="border px-6 py-4">{{ $appointment->area }}</td>
                        <td class="border px-6 py-4">{{ $appointment->date }}</td>
                        <td class="border px-6 py-4">{{ $appointment->time }}</td>
                        <td class="border px-6 py-4">{{ $appointment->status }}</td>
                        <td class="border px-6 py-4">{{ $appointment->reason }}</td>
                        <td class="border px-6 py-4">
                            <a class="bg-blue-500 rounded-sm px-2 text-white" href="{{ url('/editAppointment/' . $appointment->id) }}">
                            <i class="bi bi-pencil-square"></i></a>
                            @if ($appointment->status != 'Pendiente')
                        <a class="bg-yellow-300 rounded-sm px-2 text-white" data-bs-target="#pendingModal-{{ $appointment->id }}" data-bs-toggle="modal">
                        <i class="bi bi-clock-history"></i></a>
                        @endif
                        @if ($appointment->status != 'Completada')
                        <a class="bg-green-500 rounded-sm px-2 text-white" data-bs-target="#doneModal-{{ $appointment->id }}" data-bs-toggle="modal">
                        <i class="bi bi-check2"></i></a>
                        @endif
                        @if ($appointment->status != 'Cancelada')
                        <a class="bg-red-700 rounded-sm px-2 text-white" data-bs-target="#cancelModal-{{ $appointment->id }}" data-bs-toggle="modal">
                        <i class="bi bi-x"></i></a>
                        @endif
                        </td>
                    </tr>
                    <div class="modal fade" id="pendingModal-{{ $appointment->id }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="/changeToPending/{{ $appointment->id }}" method="POST">
                            @method('POST')
                            @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Marcar cita como pendiente</h1>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        ¿Estás seguro de que deseas marcar la cita como pendiente?
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
                    <div class="modal fade" id="doneModal-{{ $appointment->id }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="/changeToDone/{{ $appointment->id }}" method="POST">
                            @method('POST')
                            @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Marcar cita como completada</h1>
                                        <button type="button" class="btn-close" style="color: black;"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        ¿Estás seguro de que deseas marcar la cita como completada?
                                    </div>
                                </div>
                            <div class="modal-footer">
                            <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal fade" id="cancelModal-{{ $appointment->id }}"
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="/changeToCancel/{{ $appointment->id }}" method="POST">
                            @method('POST')
                            @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Marcar cita como cancelada</h1>
                                        <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close">
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        ¿Estás seguro de que deseas marcar la cita como cancelada?
                                    </div>
                                </div>
                            <div class="modal-footer">
                            <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" data-bs-dismiss="modal">Cancelar</button>
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
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
