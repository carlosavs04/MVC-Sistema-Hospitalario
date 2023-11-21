<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Log In</title>
</head>
<body class="bg-sky-200">
    <div class="mx-96 mt-10 bg-white rounded-lg shadow-lg py-8">
        <div class="">
            <h1 class="text-center text-3xl mb-8">Iniciar Sesión</h1>
            <div class="mx-40">
                <form method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" placeholder="Correo" class="form-input">
                    </div>
                    <div class="flex flex-col">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" class="form-input">
                    </div>
                    <div class="flex flex-col mt-6 mx-20">
                        <button type="submit" class="bg-blue-500 text-white rounded-md">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
