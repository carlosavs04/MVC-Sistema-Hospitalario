<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Registro</title>
</head>
<body class="bg-sky-200">
<div class="mx-96 mt-10 bg-white rounded-lg shadow-lg py-8">
        <h1 class="text-center text-3xl mb-8">Formulario de registro</h1>
        <div class="mx-40">
            <form action="/register" method="POST">
                @csrf
                @method('POST')
                <div class="flex flex-col">
                    <label for="name">Nombre(s)</label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-input">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="last_name">Apellido</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Apellido" class="form-input">
                    @error('last_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
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
                <div class="flex flex-col">
                    <label for="birthdate">Fecha de nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date" placeholder="Fecha de nacimiento" class="form-input">
                    @error('birth_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                <div class="flex flex-col">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" placeholder="Correo" class="form-input">
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="phone">Teléfono</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Teléfono" class="form-input">
                    @error('phone_number')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                <div class="flex flex-col">
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
                <div class="flex flex-col mt-6 mx-20">
                    <button type="submit" class="bg-blue-500 text-white rounded-md">Registrarse</button>
                </div>
            </form>
        </div>
</div>
</body>
</html>
