<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantAssignmentController extends Controller
{
    public function index()
    {
        $assignments = DB::table('formation_participent')
            ->join('formations', 'formation_participent.formation_id', '=', 'formations.id')
            ->join('participents', 'formation_participent.participent_id', '=', 'participents.id')
            ->select('formation_participent.*', 'formations.title as formation_title', 'participents.nom', 'participents.prenom')
            ->get();

        return response()->json([
            'assignments' => $assignments
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'participent_id' => 'required|exists:participents,id',
        ]);

        // Using insertOrIgnore to handle potential duplicates if unique constraint exists
        DB::table('formation_participent')->updateOrInsert(
            ['formation_id' => $validated['formation_id'], 'participent_id' => $validated['participent_id']],
            []
        );

        return response()->json(['message' => 'Participant assigned to formation successfully'], 201);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'formation_id' => 'required',
            'participent_id' => 'required',
        ]);

        DB::table('formation_participent')
            ->where('formation_id', $validated['formation_id'])
            ->where('participent_id', $validated['participent_id'])
            ->delete();

        return response()->json(['message' => 'Assignment removed successfully']);
    }
}
