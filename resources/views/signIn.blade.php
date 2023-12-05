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
                    <div class="flex flex-col mt-6 mx-20">
                        <button type="submit" class="bg-blue-500 text-white rounded-md">Iniciar sesión</button>
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