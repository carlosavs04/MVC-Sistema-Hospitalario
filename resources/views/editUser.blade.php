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
    <title>Editar perfil</title>
</head>

<body class="bg-sky-200">
    <x-navbar />
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">

        <!-- User Information with Rounded Image -->
        <form method="POST" action="" id="editUserForm">
            @csrf
            @method('POST')

            <div class="mb-4 flex items-center">
                <div class="row">

                    <h1 class="text-2xl font-bold mb-2">Perfil</h1>
                    <!-- User Information Fields -->
                    <!--name-->
                    <div class="mb-2 col-6">
                        <label for="name" class="block text-gray-600 text-sm font-medium mb-1">Nombre</label>
                        <input type="text" name="name" value="" class="form-input w-full" id="user-name">
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--last_name-->
                    <div class="mb-2 col-6">
                        <label for="last_name" class="block text-gray-600 text-sm font-medium mb-1">Apellidos</label>
                        <input type="text" name="last_name" value="" class="form-input w-full" id="user_lastname">
                        @error('last_name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--gender-->
                    <div class="mb-2 col-6">
                        <label for="gender" class="block text-gray-600 text-sm font-medium mb-1">Género</label><br>
                        <select name="gender" class="form-input" value="" style="margin-top: -9%;" id="user_gender">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <!--bith_date-->
                    <div class="mb-2 col-6">
                        <label for="bith_date" class="block text-gray-600 text-sm font-medium mb-1">Fecha de nacimiento</label>
                        <input type="date" name="birth_date" value="" class="form-input w-full" id="user_birthdate">
                    </div>
                    <!--email-->
                    <div class="mb-2 col-6">
                        <label for="email" class="block text-gray-600 text-sm font-medium mb-1">Correo</label>
                        <input type="text" name="email" value="" class="form-input w-full" id="user_mail">
                        @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--phone_number-->
                    <div class="mb-2 col-6">
                        <label for="phone_number" class="block text-gray-600 text-sm font-medium mb-1">Número de teléfono</label>
                        <input type="text" name="phone_number" value="" class="form-input w-full" id="user_phone">
                        @error('phone_number')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Guardar cambios
                </button>
            </div>
        </form>

    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script>
    var token = localStorage.getItem('auth_token');
    var actionUrl;

    $(document).ready(function() {
        $.ajax({
            url: '/getUserData',
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            success: function(data) {
                console.log(data);
                $('#user-name').val(data.name);
                $('#user_lastname').val(data.last_name);
                $('#user_gender').val(data.gender);
                $('#user_birthdate').val(data.birth_date);
                $('#user_mail').val(data.email);
                $('#user_phone').val(data.phone_number);
                actionUrl = '/updateUser/' + data.id;
            },
        })

        $('#editUserForm').submit(function(e) {
            e.preventDefault(); 
            $(this).attr('action', actionUrl);
            $(this).attr('method', 'POST');
            
            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    console.log(data);
                    window.location.href = '/profile';
                },
            })
        });
    });
</script>
