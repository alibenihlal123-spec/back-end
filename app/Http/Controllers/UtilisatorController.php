<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisator;

class UtilisatorController extends Controller
{
    public function login(Request $request){
            $request->validate([
                'username'=>'required|string',
                'password'=>'required|string'
            ]);

            $usernameOrEmail = $request->input('username');
            $password = $request->input('password');

            $utilisator = Utilisator::where('username', $usernameOrEmail)
                ->orWhere('email', $usernameOrEmail)
                ->first();

            if (!$utilisator || !\Illuminate\Support\Facades\Hash::check($password, $utilisator->password)) {
                return response()->json([
                    'message'=>'invalid username or password'
                ],401);
            }

            Auth::login($utilisator);
            $utilisator->load(['participent.formations', 'animater.formations']);

            $token = $utilisator->createToken('test')->plainTextToken;

            return response()->json([
                'token'=>$token,
                'user'=>$utilisator
            ]);
    }

    public function index()
    {
        return response()->json([
            'users' => Utilisator::all()
        ]);
    }
}
