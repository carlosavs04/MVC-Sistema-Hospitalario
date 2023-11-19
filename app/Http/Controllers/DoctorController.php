<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function index() 
    {
        $doctors = User::join('specialties', 'users.specialty_id', '=', 'specialties.id')
        ->select('users.*', 'specialties.name as specialty_name')->where('role_id', 2)->get();

        return view('doctors', ['doctors' => $doctors]);
    }

    public function create() 
    {
        $users = User::where('role_id', 1)->get();

        return view('addDoctor', ['users' => $users, 'specialties' => Specialty::all()]);
    }

    public function add(Request $request, int $userId) 
    {
        $validate = Validator::make($request->all(), 
        [
            'specialty_id' => 'required|integer'
        ],
        [
            'specialty_id.required' => 'El campo :attribute es obligatorio',
            'specialty_id.integer' => 'El campo :attribute debe ser un número entero'
        ]);

        if ($validate->fails()) 
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::find($userId);

        if ($user) 
        {        
            $user->specialty_id = $request->specialty_id;
            $user->role_id = 2;
            
            if($user->save()) 
            {
                return redirect()->route('doctors')->with(
                [
                    'status' => 'success',
                    'message' => 'Doctor agregado correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function edit(int $userId) 
    {
        $user = User::find($userId);

        if ($user) 
        {
            return view('editDoctor', ['user' => $user, 'specialties' => Specialty::all()]);
        }
    }

    public function update(Request $request, int $userId) 
    {
        $validate = Validator::make($request->all(), 
        [
            'specialty_id' => 'required|integer'
        ],
        [
            'specialty_id.required' => 'El campo :attribute es obligatorio',
            'specialty_id.integer' => 'El campo :attribute debe ser un número entero'
        ]);

        if ($validate->fails()) 
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::find($userId);

        if ($user) 
        {        
            $user->specialty_id = $request->specialty_id;
            
            if($user->save()) 
            {
                return redirect()->route('doctors')->with(
                [
                    'status' => 'success',
                    'message' => 'Doctor actualizado correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function delete(int $userId) 
    {
        $user = User::find($userId);

        if ($user) 
        {
            $user->specialty_id = null;
            $user->role_id = 1;
            
            if($user->save()) 
            {
                return redirect()->route('doctors')->with(
                [
                    'status' => 'success',
                    'message' => 'Doctor eliminado correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function appoinmentsForDoctor() 
    {
        $user = User::find(auth()->user()->id);

        if ($user) 
        {
            $appointments = Appointment::where('doctor_id', $user->id)->get();

            if ($appointments) 
            {
                foreach ($appointments as $appointment) 
                {
                    $appointment->patient = User::find($appointment->patient_id)->select('name', 'lastname')->first();
                }
                return view('myAppoinments/doctor', ['appointments' => $appointments]);
            }
        }
    }
}
