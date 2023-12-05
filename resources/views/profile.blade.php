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
    <title>Mi perfil</title>
</head>

<body class="bg-sky-200">
    <x-navbar />
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow-md">

        <!-- User Information -->
        <div class="mb-4">
            <h1 class="text-2xl font-bold mb-2">Perfil</h1>
            <div class="row">
                <div class="col-6">
                    <p><strong>Nombre:</strong> <span id="user_name"></span></p>
                    <p><strong>Apellidos:</strong> <span id="user_lastname"></span></p>
                    <p><strong>Género:</strong> <span id="user_gender"></span>
                    <p>
                    <p><strong>Fecha de nacimiento:</strong> <span id="user_birthdate"></span></p>
                    <p><strong>Correo electrónico:</strong> <span id="user_mail"></span></p>
                    <p><strong>Número de teléfono:</strong> <span id="user_phone"></span></p>
                    <p id="insurance-patient"><strong>Aseguradora:</strong> <span id="user_insurance"></span></p>
                    <p id="insurance-plan"><strong>Plan de seguro:</strong> <span id="user_plan"></span></p>
                    <p id="doctor-specialty"><strong>Especialidad:</strong> <span id="user_specialty"></span></p>
                </div>
                <div class="col-6">
                    <img class="rounded-full w-30 h-30 mr-4" src="{{ asset('img/broly.jpg') }}" alt="Flor_Broly">

                </div>

            </div>
        </div>

        <!-- Edit Profile Button -->
        <div class="text-right row">
            <div class="col-3">
                <a href="editUser/" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Editar perfil
                </a>
            </div>
            <div class="col-3">
                <a href="editUser/" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                    Mis citas
                </a>
            </div>
        </div>

    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script>
    var token = localStorage.getItem('auth_token');
    var role_id = localStorage.getItem('role_id');

    $(document).ready(function() {
        if (role_id == 1) {
            $('#doctor-specialty').hide();
            $('#insurance-patient').show();
            $('#insurance-plan').show();
        }
        if (role_id == 2) {
            $('#doctor-specialty').show();
            $('#insurance-patient').hide();
            $('#insurance-plan').hide();
        } else {
            $('#doctor-specialty').hide();
            $('#insurance-patient').hide();
            $('#insurance-plan').hide();
        }

        $.ajax({
            url: '/getUserData',
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            },
            success: function(data) {
                $('#user_name').html(data.name);
                $('#user_lastname').html(data.last_name);
                $('#user_birthdate').html(data.birth_date);
                $('#user_mail').html(data.email);
                $('#user_phone').html(data.phone_number);

                if (data.gender == 'M') {
                    $('#user_gender').html('Masculino');
                } else {
                    $('#user_gender').html('Femenino');
                }

                if (data.specialty == null) {
                    $('#user_specialty').html('');
                } else {
                    $('#user_specialty').html(data.specialty);
                }

                if (data.insurance == null) {
                    $('#user_insurance').html('');
                    $('#user_plan').html('');
                } else {
                    $('#user_insurance').html(data.insurance);
                    $('#user_plan').html(data.plan);
                }
            },
        })
    });
</script>
