<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'apellidos' => 'required|min:5|max:30',
            'telefono' => 'required',
            'email' => 'required|unique:clientes|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error de validación', 'errors' => $validator->errors()], 422);
        }

        $cliente = Cliente::create([
            'name' => $request->input('name'),
            'apellidos' => $request->input('apellidos'),
            'telefono' => $request->input('telefono'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        
        $token = $cliente->createToken('auth_token')->plainTextToken;        

        return response()->json([
            'message' => 'Cliente registrado con éxito',
            'data' => $cliente,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'No autorizado'], 401);
        }

        $user = Cliente::where('email', $request['email'])->firstOrFail();

        if (!Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => 'No autorizado'], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Hola ' . $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
}