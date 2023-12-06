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
    @vite('resources/css/app.css')
    <title>Pacientes</title>
</head>
<body class="bg-sky-200">
    <x-navbar></x-navbar>
    <h1 class="text-center text-3xl my-4">Pacientes</h1>
    <div class="flex justify-center">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-gray-800 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="border px-6 py-3">Id</th>
                        <th scope="col" class="border px-6 py-3">Nombre</th>
                        <th scope="col" class="border px-6 py-3">Apellidos</th>
                        <th scope="col" class="border px-6 py-3">Correo electrónico</th>
                        <th scope="col" class="border px-6 py-3">Género</th>
                        <th scope="col" class="border px-6 py-3">Fecha de nacimiento</th>
                        <th scope="col" class="border px-6 py-3">Plan de Seguros</th>
                        <th scope="col" class="border px-6 py-3">Aseguradora</th>
                        <th scope="col" class="border px-6 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patients as $patient)
                    <tr class="bg-white">
                        <td class="border px-6 py-4">{{ $patient->id }} </td>
                        <td class="border px-6 py-4">{{ $patient->name }}</td>
                        <td class="border px-6 py-4">{{ $patient->last_name }}</td>
                        <td class="border px-6 py-4">{{ $patient->email }}</td>
                        <td class="border px-6 py-4">{{ $patient->gender }}</td>
                        <td class="border px-6 py-4">{{ $patient->birth_date}}</td>
                        <td class="border px-6 py-4">{{ $patient->insurance_plan }}</td>
                        <td class="border px-6 py-4">{{ $patient->insurance_name }}</td>
                        <td class="border px-6 py-4">
                            <button class="bg-blue-500 rounded-sm px-2 text-white">
                                <i class="bi bi-pencil-square"
                                    data-bs-target="#modal-{{ $patient->id }}"
                                    data-bs-toggle="modal">
                                </i>
                            </button>
                            @if($patient->insurance_name)
                            <a href="/deleteInsurance/{{ $patient->id }}">
                                <button class="bg-red-600 rounded-sm px-2 text-white">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </a>
                            @endif
                            <button class="bg-green-500 rounded-sm px-2 text-white"
                            data-bs-target="#doctor-{{$patient->id}}"
                            data-bs-toggle="modal">
                                <i class="bi bi-capsule"></i>
                            </button>
                            {{-- Modal Conversión a Doctor --}}
                            <div class="modal fade" id="doctor-{{ $patient->id }}"
                                tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <form action="/addDoctor/{{ $patient->id }}" method="POST">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Convertir a médico</h1>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                        </div>
                                        <div class="modal-body">
                                            @method('POST')
                                            @csrf
                                            <div class="mb-3">
                                                <label for="insurance_id" class="form-label">Especialidad</label><br>
                                                <select name="specialty_id">
                                                    @foreach ($specialties as $specialty )
                                                    <option value={{$specialty->id}}>
                                                        {{ $specialty->name }}</option>
                                                    @endforeach
                                                </select>
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
                        </td>
                        <div class="modal fade" id="modal-{{ $patient->id }}"
                            tabindex="-1"
                            aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <form action="/updateInsurancePlan/{{ $patient->id }}" method="POST">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Aseguradora</h1>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                    </div>
                                    <div class="modal-body">
                                        @method('POST')
                                        @csrf
                                        <div class="mb-3">
                                            <label for="insurance_id" class="form-label">Aseguradora</label><br>
                                            <select name="insurance_id">
                                                @foreach ($insurances as $insurance )
                                                @php
                                                    $selected = $patient->insurance_id === $insurance->id
                                                    ? 'selected' : '' ;
                                                @endphp
                                                <option {{$selected}} value={{$insurance->id}}>
                                                    {{ $insurance->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Plan de seguros</label><br>
                                            <select name="insurance_plan">
                                                @foreach ($plans as $plan)
                                                @php
                                                $selected2 = $patient->insurance_plan === $plan
                                                ? 'selected' : '' ;
                                                @endphp
                                                <option {{$selected2}} value={{$plan}}>{{ $plan }}</option>
                                                @endforeach
                                            </select>
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
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
