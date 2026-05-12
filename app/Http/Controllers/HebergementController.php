<?php

namespace App\Http\Controllers;

use App\Models\Hebergement;
use Illuminate\Http\Request;

class HebergementController extends Controller
{
    public function index()
    {
        return response()->json([
            'hebergements' => Hebergement::with('participant')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'participent_id' => 'required|exists:participents,id',
            'lieu' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'prix' => 'nullable|numeric',
        ]);

        $hebergement = Hebergement::create($validated);

        return response()->json([
            'message' => 'Hebergement saved successfully',
            'data' => $hebergement->load('participant')
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $hebergement = Hebergement::findOrFail($id);
        $validated = $request->validate([
            'participent_id' => 'exists:participents,id',
            'lieu' => 'string|max:255',
            'date_debut' => 'date',
            'date_fin' => 'date|after_or_equal:date_debut',
            'prix' => 'nullable|numeric',
        ]);

        $hebergement->update($validated);

        return response()->json([
            'message' => 'Hebergement updated successfully',
            'data' => $hebergement->load('participant')
        ]);
    }

    public function destroy(string $id)
    {
        $hebergement = Hebergement::findOrFail($id);
        $hebergement->delete();

        return response()->json(['message' => 'Hebergement deleted successfully']);
    }
}
