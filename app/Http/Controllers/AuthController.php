<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp()
    {
        return view('signUp');
    }

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'gender' => 'required|string|max:1',
            'birth_date' => 'required|date',
            'email' => 'required|string|email:rfs,dns|max:100|unique:users',
            'phone_number' => 'required|string|max:10',
            'password' => 'required|string|min:8|max:30',
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
            'phone_number.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
            'password.required' => 'El campo :attribute es obligatorio',
            'password.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'password.min' => 'El campo :attribute debe contener al menos :min caracteres',
            'password.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
        ]);

        if ($validate->fails())
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if($password != $passwordConfirmation)
        {
            return back()->with(
                [
                    'status' => 'error',
                    'message' => 'Las contraseñas no coinciden',
                    'data' => []
                ]
            );
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);

        if($user->save())
        {
            return redirect()->route('login')->with(
                [
                    'status' => 'success',
                    'message' => 'Usuario registrado exitosamente',
                    'data' => $user
                ]
            );
        }
    }

    public function signIn()
    {
        return view('signIn');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'email' => 'required|string|email:rfs,dns|max:100',
            'password' => 'required|string|min:8|max:30',
        ],
        [
            'email.required' => 'El campo :attribute es obligatorio',
            'email.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'email.email' => 'El campo :attribute debe ser un correo electrónico válido',
            'email.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
            'password.required' => 'El campo :attribute es obligatorio',
            'password.string' => 'El campo :attribute debe ser una cadena de caracteres',
            'password.min' => 'El campo :attribute debe contener al menos :min caracteres',
            'password.max' => 'El campo :attribute puede contener un máximo de :max caracteres',
        ]);

        if ($validate->fails())
        {
            $errors = $validate->errors();
            return back()->withErrors($errors);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {
            return back()->with(
                [
                    'status' => 'error',
                    'message' => 'Credenciales de usuario incorrectas',
                    'data' => []
                ]
            );
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('home')->with(
            [
                'status' => 'success',
                'message' => 'Sesión iniciada exitosamente',
                'data' => $user,
                'token' => $token
            ]
        );
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return redirect()->route('login')->with(
            [
                'status' => 'success',
                'message' => 'Sesión cerrada exitosamente',
                'data' => []
            ]
        );
    }
}
