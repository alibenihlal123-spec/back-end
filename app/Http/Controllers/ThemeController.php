<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(){
        $themes = Theme::all();
        return response()->json([
            "themes"=>$themes
        ]);
    }
}
