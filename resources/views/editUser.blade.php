<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- l<link real="stylesheet" href="{{ asset('css/carrusel.css') }}"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/carrusel.css')
    <title>Registro</title>
</head>

<body class="bg-sky-200">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <h1 class="text-gray-300 px-3 py-2" style="font-size:large;">Bienvenido</h1>
                            <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Agendar Cita</a>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                                <!-- Profile dropdown -->
                                <div class="relative ml-3 ">
                                    <div class="dropdown">
                                        <button class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium bg-gray-900" style="color: white;"><span class="material-symbols-outlined" style="margin: auto;">

                                            </span>Mas opciones</button>
                                        <div class="dropdown-content">
                                            <a href="#">Ver aseguradores</a>
                                            <a href="#">ver doctores</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3 ">
                        <div class="dropdown">
                            <button class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium bg-gray-900" style="color: white;"><span class="material-symbols-outlined" style="margin: auto;">
                                    menu
                                </span></button>
                            <div class="dropdown-content">
                                <a href="/profile">Mi perfil</a>
                                <a href="#">Cerrar sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">

        <!-- User Information with Rounded Image -->
        <form method="POST" action="">
            @csrf
            @method('POST')

            <div class="mb-4 flex items-center">
                <div class="row">

                    <h1 class="text-2xl font-bold mb-2">Perfil</h1>
                    <div class="col-12">
                        <img class="rounded-full w-16 h-16 mr-4" src="{{ asset('img/broly.jpg') }}" alt="Flor_Broly">
                    </div>
                    <!-- User Information Fields -->
                    <!--name-->
                    <div class="mb-2 col-6">
                        <label for="name" class="block text-gray-600 text-sm font-medium mb-1">Nombre</label>
                        <input type="text" name="name" id="name" value="" class="form-input w-full">
                    </div>
                    <!--last_name-->
                    <div class="mb-2 col-6">
                        <label for="last_name" class="block text-gray-600 text-sm font-medium mb-1">Apellidos</label>
                        <input type="text" name="last_name" id="last_name" value="" class="form-input w-full">
                    </div>
                    <!--gender-->
                    <div class="mb-2 col-6">
                        <label for="gender" class="block text-gray-600 text-sm font-medium mb-1">Género</label><br>
                        <select name="gender" id="gender" class="form-input" value="" style="margin-top: -9%;">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <!--bith_date-->
                    <div class="mb-2 col-6">
                        <label for="bith_date" class="block text-gray-600 text-sm font-medium mb-1">Fecha de nacimiento</label>
                        <input type="date" name="bith_date" id="bith_date" value="" class="form-input w-full">
                    </div>
                    <!--email-->
                    <div class="mb-2 col-6">
                        <label for="email" class="block text-gray-600 text-sm font-medium mb-1">Correo</label>
                        <input type="text" name="email" id="email" value="" class="form-input w-full">
                    </div>
                    <!--phone_number-->
                    <div class="mb-2 col-6">
                        <label for="phone_number" class="block text-gray-600 text-sm font-medium mb-1">Numero de telefono</label>
                        <input type="text" name="phone_number" id="phone_number" value="" class="form-input w-full">
                    </div>
                    <!--role_id-->
                    <div class="mb-2 col-6">
                        <label for="role_id" class="block text-gray-600 text-sm font-medium mb-1">Rol</label>
                        <input type="text" name="role_id" id="role_id" value="" class="form-input w-full">
                    </div>
                    <!--insurance_id-->
                    <div class="mb-2 col-6">
                        <label for="insurance_id" class="block text-gray-600 text-sm font-medium mb-1">insurance_id</label>
                        <input type="text" name="insurance_id" id="insurance_id" value="" class="form-input w-full">
                    </div>
                    <!--insurance_plan-->
                    <div class="mb-2 col-6">
                        <label for="insurance_plan" class="block text-gray-600 text-sm font-medium mb-1">insurance_plan</label>
                        <input type="text" name="insurance_plan" id="insurance_plan" value="" class="form-input w-full">
                    </div>
                    <!--speciality_id-->
                    <div class="mb-2 col-6">
                        <label for="speciality_id" class="block text-gray-600 text-sm font-medium mb-1">speciality_id</label>
                        <input type="text" name="insurance_id" id="speciality_id" value="" class="form-input w-full">
                    </div>
                    <!--password-->
                    <div class="mb-2 col-12">
                        <label for="password" class="block text-gray-600 text-sm font-medium mb-1">Contraseña</label>
                        <input type="text" name="password" id="password" value="" class="form-input w-full">
                    </div>
                    <!--passwordConfirm-->
                    <div class="mb-2 col-12">
                        <label for="password" class="block text-gray-600 text-sm font-medium mb-1">Confirmar Contraseña</label>
                        <input type="text" name="password" id="password" value="" class="form-input w-full">
                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Guardar Cambios
                </button>
            </div>
        </form>

    </div>
</body>

</html>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
