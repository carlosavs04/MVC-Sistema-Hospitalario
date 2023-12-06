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
    <title>Agendar cita</title>
</head>

<body class="bg-sky-200">
    <x-navbar />
    <div class="container mx-auto mt-2">
        <div class="max-w-md mx-auto">
            <div class="bg-white p-6 rounded-md shadow-md ma">
                <h2 class="text-2xl font-semibold mb-6">Editar cita</h2>

                <form method="POST" action="" id="appointmentForm">
                    @csrf
                    @method('POST')
                    <div class="mb-2">
                        <label for="date" class="block text-sm font-medium text-gray-600">Fecha</label>
                        <input type="date" name="date" id="date" class="mt-1 p-2 w-full border rounded-md" min="{{ date('Y-m-d') }}" value="{{ $appointment->date }}">
                    </div>

                    <div class="mb-2">
                        <label for="time" class="block text-sm font-medium text-gray-600">Hora</label>
                        <input type="time" name="time" id="time" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ $appointment->time }}"
                        min="7:30"
                        max="22:00">
                    </div>
                    <div class="mb-2">
                        <label for="doctor" class="block text-sm font-medium text-gray-600">Médico</label>
                        <select name="doctor_id" id="doctor_id" class="mt-1 p-2 w-full border rounded-md">
                            <option value="{{ $appointment->doctor_id }}" selected>{{ $doctorSelected->name }} {{ $doctorSelected->last_name }}</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }} {{ $doctor->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="motivo" class="block text-sm font-medium text-gray-600">Motivo</label>
                        <textarea name="reason" id="reason" class="mt-1 p-2 w-full border rounded-md" rows="2">{{ $appointment->reason }}</textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    var userId = {{ $id }};
    $(document).ready(function() {
        $('#appointmentForm').submit(function(event) {
            event.preventDefault();
            $(this).attr('action', '/updateAppointment/' + userId)
            $(this).attr('method', 'POST')

            $.ajax({
                url: '/updateAppointment/' + userId,
                method: 'POST',
                data: $(this).serialize(),
            success: function(data) {
                console.log(data);
                history.back();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    });

    document.getElementById('date').addEventListener('input', function() {
        var currentDate = new Date().toISOString().split('T')[0];
        if (this.value < currentDate) {
            this.value = currentDate;
            document.getElementById('time').min = new Date().toLocaleTimeString('en-US', { hour12: false });
        } else {
            document.getElementById('time').min = '00:00';
        }
    });

    document.getElementById('time').addEventListener('input', function() {
        var currentTime = new Date().toLocaleTimeString('en-US', { hour12: false });
        if (this.value < currentTime || (this.value >= '22:00' && this.value <= '07:30')) {
            this.value = currentTime;
        }
    });
</script>
