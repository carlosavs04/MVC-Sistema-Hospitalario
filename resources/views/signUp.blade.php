<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    @vite('resources/css/app.css')
    <title>Registro</title>
</head>

<body class="bg-sky-200">
    <div class="mx-96 mt-10 bg-white rounded-lg shadow-lg py-8">
        <h1 class="text-center text-3xl mb-8">Formulario de registro</h1>
        <div style="margin-right: 4%;margin-left: 4%;">
            <form action="/register" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-6">
                        <label for="name">Nombre(s)</label>
                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-input">
                        @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="last_name">Apellido</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Apellido" class="form-input">
                        @error('last_name')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="gender">Género</label><br>
                        <select name="gender" id="gender" class="form-input">
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        @error('gender')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="birthdate">Fecha de nacimiento</label>
                        <input type="date" name="birth_date" id="birth_date" placeholder="Fecha de nacimiento" class="form-input">
                        @error('birth_date')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                        <div class="col-6">
                            <label for="email">Correo</label>
                            <input type="email" name="email" id="email" placeholder="Correo" class="form-input">
                            @error('email')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="phone">Teléfono</label>
                            <input type="tel" name="phone_number" id="phone_number" placeholder="Teléfono" class="form-input">
                            @error('phone_number')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="Contraseña" class="form-input">
                            @error('password')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="password_confirmation">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" class="form-input">
                        </div>
                        <div class="flex flex-col mt-6">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Registrarse</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>
