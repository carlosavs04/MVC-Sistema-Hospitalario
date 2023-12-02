<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getUserData()
    {
        return view('profile', ['user' => User::find(auth()->user()->id)]);
        // return view('profile');
    }

    public function edit()
    {
        return view('editUser', ['user' => User::find(auth()->user()->id)]);
        // return view('editUser');
    }

    public function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:60',
                'last_name' => 'required|string|max:60',
                'gender' => 'required|string|max:1',
                'birth_date' => 'required|date',
                'email' => 'required|string|email:rfs,dns|max:100|unique:users',
                'phone_number' => 'required|string|max:10'
            ],
            [
                'name.required' => 'El campo :attribute es obligatorio',
                'name.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'name.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
                'last_name.required' => 'El campo :attribute es obligatorio',
                'last_name.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'last_name.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
                'gender.required' => 'El campo :attribute es obligatorio',
                'gender.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'gender.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
                'birth_date.required' => 'El campo :attribute es obligatorio',
                'birth_date.date' => 'El campo :attribute debe ser una fecha',
                'email.required' => 'El campo :attribute es obligatorio',
                'email.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'email.email' => 'El campo :attribute debe ser un correo electrónico válido',
                'email.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
                'email.unique' => 'El campo :attribute ya se encuentra en uso',
                'phone_number.required' => 'El campo :attribute es obligatorio',
                'phone_number.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'phone_number.max' => 'El campo :attribute puede contener un máximo de :max caracteres'
            ]
        );

        if ($validate->fails()) {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::find(auth()->user()->id);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($user->save()) {
            return redirect()->route('profile')->with(
                [
                    'status' => 'success',
                    'message' => 'Datos actualizados correctamente',
                    'data' => $user
                ]
            );
        }
    }

    public function editPassword()
    {
        return view('editPassword', ['user' => User::find(auth()->user()->id)]);
    }

    public function updatePassword(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'actual_password' => 'required|string|min:8|max:30',
                'new_password' => 'required|string|min:8|max:30'
            ],
            [
                'actual_password.required' => 'El campo :attribute es obligatorio',
                'actual_password.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'actual_password.min' => 'El campo :attribute debe contener al menos :min caracteres',
                'actual_password.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
                'new_password.required' => 'El campo :attribute es obligatorio',
                'new_password.string' => 'El campo :attribute debe ser una cadena de caracteres',
                'new_password.min' => 'El campo :attribute debe contener al menos :min caracteres',
                'new_password.max' => 'El campo :attribute puede contener un máximo de :max caracteres'
            ]
        );

        if ($validate->fails()) {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->actual_password, $user->password)) {
            $user->password = Hash::make($request->new_password);

            if ($user->save()) {
                return redirect()->route('profile')->with(
                    [
                        'status' => 'success',
                        'message' => 'Contraseña actualizada correctamente',
                        'data' => $user
                    ]
                );
            }
        } else {
            return redirect()->back()->with(
                [
                    'status' => 'error',
                    'message' => 'La contraseña actual no coincide con la que acabas de ingresar',
                    'data' => $user
                ]
            );
        }
    }
}
