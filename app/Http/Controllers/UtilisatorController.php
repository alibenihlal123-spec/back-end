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

            $data = $request->only(['username','password']);

            if(! Auth::attempt($data)){
                return response()->json([
                    'message'=>'invalid username or password'
                ],401);
            }

            $utilisator = Auth::user();

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
