<?php

namespace App\Http\Controllers;

use App\Models\Animater;
use Illuminate\Http\Request;

class AnimatorController extends Controller
{
    public function index(){
        $animators = Animater::all();
        return response()->json([
            "animators"=>$animators
        ]);
    }
}
