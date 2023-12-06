<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    function index()
    {
        $appointments = Appointment::join('users as patients', 'appointments.patient_id', '=', 'patients.id')
            ->join('users as doctors', 'appointments.doctor_id', '=', 'doctors.id')
            ->join('specialties', 'doctors.specialty_id', '=', 'specialties.id')
            ->select('appointments.*', 'patients.name as patient_name', 'patients.last_name as patient_lastname', 'doctors.name as doctor_name', 'doctors.last_name as doctor_lastname', 'specialties.name as area')
            ->get();

        return view('appointments', ['appointments' => $appointments]);
    }

    function create()
    {
        $doctors = User::where('role_id', 2)->get();
        return view('appoinment', ['doctors' => $doctors]);
    }

    function add(Request $request, int $userId)
    {
        $validate = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
            'reason' => 'required|string|max:300',
            'doctor_id' => 'required|integer'
        ],
        [
            'date.required' => 'El campo :attribute es obligatorio',
            'date.date' => 'El campo :attribute debe ser una fecha',
            'time.required' => 'El campo :attribute es obligatorio',
            'reason.required' => 'El campo :attribute es obligatorio',
            'reason.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'reason.max' => 'El campo :attribute debe tener máximo 300 caracteres',
            'doctor_id.required' => 'El campo :attribute es obligatorio',
            'doctor_id.integer' => 'El campo :attribute debe ser un número entero'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $appointment = Appointment::create([
            'patient_id' => $userId,
            'date' => $request->date,
            'time' => $request->time,
            'reason' => $request->reason,
            'doctor_id' => $request->doctor_id
        ]);

        if ($appointment->save()) {
            return redirect()->route('home')->with(
                [
                    'status' => 'success',
                    'message' => 'Cita agregada correctamente',
                    'data' => $appointment
                ]
            );
        }
    }

    function edit(int $id)
    {
        $appointment = Appointment::find($id);
        $doctorSelected = User::find($appointment->doctor_id);
        $doctors = User::where('role_id', 2)->where('id', '!=', $doctorSelected->id)->get();
        return view('editAppointment', ['appointment' => $appointment, 'doctors' => $doctors, 'doctorSelected' => $doctorSelected, 'id' => $id]);
    }

    function update(Request $request, int $id) 
    {
        $validate = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
            'reason' => 'required|string|max:300',
            'doctor_id' => 'required|integer'
        ],
        [
            'date.required' => 'El campo :attribute es obligatorio',
            'date.date' => 'El campo :attribute debe ser una fecha',
            'time.required' => 'El campo :attribute es obligatorio',
            'reason.required' => 'El campo :attribute es obligatorio',
            'reason.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'reason.max' => 'El campo :attribute debe tener máximo 300 caracteres',
            'doctor_id.required' => 'El campo :attribute es obligatorio',
            'doctor_id.integer' => 'El campo :attribute debe ser un número entero'
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $appointment = Appointment::find($id);
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->reason = $request->reason;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->save();

        return redirect()->back()->with(
                [
                    'status' => 'success',
                    'message' => 'Cita actualizada correctamente',
                    'data' => $appointment
                ]
            );
    }
}
