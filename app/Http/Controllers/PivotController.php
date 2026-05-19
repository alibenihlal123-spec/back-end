<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PivotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'pivots' => Pivot::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'animater_id' => 'required|exists:animaters,id',
            'theme_id' => 'required|exists:themes,id',
        ]);

        // Create assignment for this combination if it doesn't exist
        $pivot = Pivot::firstOrCreate([
            'formation_id' => $validated['formation_id'],
            'animater_id' => $validated['animater_id'],
            'theme_id' => $validated['theme_id']
        ]);

        return response()->json([
            'message' => 'Assignment saved successfully',
            'data' => $pivot
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Pivot::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pivot = Pivot::find($id);
        if (!$pivot) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $validated = $request->validate([
            'formation_id' => 'exists:formations,id',
            'animater_id' => 'exists:animaters,id',
            'theme_id' => 'exists:themes,id',
        ]);

        $pivot->update($validated);

        return response()->json([
            'message' => 'Assignment updated successfully',
            'data' => $pivot
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'formation_id' => 'required',
            'animater_id' => 'required',
            'theme_id' => 'required',
        ]);

        Pivot::where($validated)->delete();

        return response()->json(['message' => 'Assignment deleted successfully']);
    }
}
