<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index()
    {

        $patients = User::leftJoin('insurances', 'users.insurance_id', '=', 'insurances.id')
        ->where('role_id', 1)
        ->select('users.id', 'users.name', 'users.last_name',
        'users.email','users.gender', 'users.birth_date',
        'users.insurance_plan', 'users.insurance_id', 'insurances.name as insurance_name')
        ->get();

        $insurances = Insurance::all();
        $plans = ['Flex A', 'Flex B', 'Práctico' ,'Íntegro', 'Pleno'];

        // return response()->json($patients, 200);

        return view('patients',[
        'patients' => $patients,
        'insurances' => $insurances,
        'plans' => $plans,
        'specialties' => Specialty::all()]);
    }

    public function assignInsurance(int $userId)
    {
        $user = User::find($userId);
        return view('assignInsurance', ['user' => $user, 'insurances' => Insurance::all()]);
    }

    public function addInsurance(Request $request, int $userId)
    {
        $validate = Validator::make($request->all(),
        [
            'insurance_id' => 'required|integer',
            'insurance_plan' => 'required|string|max:60'
        ],
        [
            'insurance_id.required' => 'El campo :attribute es obligatorio',
            'insurance_id.integer' => 'El campo :attribute debe ser un número entero',
            'insurance_plan.required' => 'El campo :attribute es obligatorio',
            'insurance_plan.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'insurance_plan.max' => 'El campo :attribute debe tener máximo 60 caracteres'
        ]);

        if ($validate->fails())
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::find($userId);

        if ($user)
        {
            $user->insurance_id = $request->insurance_id;
            $user->insurance_plan = $request->insurance_plan;

            if($user->save())
            {
                return redirect()->route('patients')->with(
                [
                    'status' => 'success',
                    'message' => 'Compañía de seguros asignada correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function editInsurance(int $userId)
    {
        $user = User::find($userId);

        if ($user)
        {
            return view('editInsurance', ['user' => $user, 'insurances' => Insurance::all()]);
        }
    }

    public function updateInsurance(Request $request, int $userId)
    {
        $validate = Validator::make($request->all(),
        [
            'insurance_id' => 'required|integer',
            'insurance_plan' => 'required|string|max:60'
        ],
        [
            'insurance_id.required' => 'El campo :attribute es obligatorio',
            'insurance_id.integer' => 'El campo :attribute debe ser un número entero',
            'insurance_plan.required' => 'El campo :attribute es obligatorio',
            'insurance_plan.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'insurance_plan.max' => 'El campo :attribute debe tener máximo 60 caracteres'
        ]);

        if ($validate->fails())
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::all()->find($userId);

        if($user)
        {
            $user->insurance_id = $request->insurance_id;
            $user->insurance_plan = $request->insurance_plan;

            if($user->save())
            {
                return redirect()->route('patients')->with(
                [
                    'status' => 'success',
                    'message' => 'Compañía de seguros actualizada correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function deleteInsurance(int $userId)
    {
        $user = User::find($userId);

        if ($user)
        {
            $user->insurance_id = null;
            $user->insurance_plan = null;

            if($user->save())
            {
                return redirect()->route('patients')->with(
                [
                    'status' => 'success',
                    'message' => 'Compañía de seguros eliminada correctamente',
                    'data' => $user
                ]);
            }
        }
    }

    public function appointmentsForPatient(int $userId)
    {
        $user = User::find($userId);
        if ($user)
        {
            $appointments = Appointment::where('patient_id', $user->id)->get();

            if ($appointments)
            {
                foreach ($appointments as $appointment)
                {
                    $doctor = User::find($appointment->doctor_id);
                    $appointment->doctor = $doctor->name . ' ' . $doctor->last_name;
                    $specialty = Specialty::find($doctor->specialty_id);
                    $appointment->area = $specialty->name;
                }
                return view('appointmentsForPatient', ['appointments' => $appointments]);
            }
        }
    }
}
