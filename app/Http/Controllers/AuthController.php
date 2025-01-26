<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect']
      ]);
    }

    return $user->createToken('secretkey')->plainTextToken;
  }

  function registration(Request $request)
  {
    $request->validate([
      'name' => 'required|min:3|max:255',
      'email' => 'required|email',
      'password' => 'required|min:5',
    ]);

    if (User::where('email', '==', $request->email)) {
      return response()->json([
        'status' => false,
        'statusCode' => 400,
        'message' => 'email already used!'
      ]);
    }

    $newUser = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return response()->json([
      'status' => true,
      'statusCode' => 200,
      'message' => 'Registration Successfully'
    ]);
  }
}
