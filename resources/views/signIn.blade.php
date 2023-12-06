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
            <h1 class="text-center text-3xl mb-8">Iniciar sesión</h1>
            <div class="mx-40">
                <form action="/login" method="POST" id="loginForm">
                    @csrf
                    @method('POST')
                    @error('email' || 'password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                    <div class="flex flex-col">
                        <label for="email">Correo</label>
                        <input type="email" name="email" id="email" placeholder="Correo" class="form-input">
                    </div>
                    <div class="flex flex-col">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="Contraseña" class="form-input">
                    </div>
                    <div class="flex flex-col mt-6" style="width: 103%;">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Iniciar Sesión</button>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('/login', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                console.log(data)
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('isLogged', true);
                localStorage.setItem('role_id', data.data.role_id);
                window.location.href = '/home';
            } else {
                console.error('No se recibió un token del servidor');
            }
        })
        .catch(error => {
            console.error('Error al realizar la solicitud de inicio de sesión:', error);
        });
    });
</script>
