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

        <!-- User Information -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold mb-2">Perfil</h1>
            <div>
                <img class="rounded-full w-16 h-16 mr-4" src="{{ asset('img/broly.jpg') }}" alt="Flor_Broly">
                <p><strong>Name:</strong> John</p>
                <p><strong>Last Name:</strong> Doe</p>
                <p><strong>Gender:</strong> Male</p>
                <p><strong>Birth Date:</strong> 01/01/1990</p>
                <p><strong>Email:</strong> john.doe@example.com</p>
                <p><strong>Phone Number:</strong> +1234567890</p>
                <!-- Avoid displaying sensitive information like password -->
                <p><strong>Password:</strong>********</p>
                <p><strong>Role ID:</strong> 123</p>
                <p><strong>Insurance ID:</strong> ABC123</p>
                <p><strong>Insurance Plan:</strong> Basic</p>
                <p><strong>Speciality ID:</strong> XYZ456</p>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <div class="text-right">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                Editar Perfil
            </button>
        </div>

    </div>
</body>

</html>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
