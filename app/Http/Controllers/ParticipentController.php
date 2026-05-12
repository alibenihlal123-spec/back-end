<?php

namespace App\Http\Controllers;

use App\Models\Participent;
use Illuminate\Http\Request;

class ParticipentController extends Controller
{
    public function index()
    {
        return response()->json([
            'participents' => Participent::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $participent = Participent::create($validated);

        return response()->json([
            'message' => 'Participant added successfully',
            'data' => $participent
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $participent = Participent::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'email' => 'email',
        ]);

        $participent->update($validated);

        return response()->json([
            'message' => 'Participant updated successfully',
            'data' => $participent
        ]);
    }

    public function destroy(string $id)
    {
        $participent = Participent::findOrFail($id);
        $participent->delete();

        return response()->json(['message' => 'Participant deleted successfully']);
    }
}
