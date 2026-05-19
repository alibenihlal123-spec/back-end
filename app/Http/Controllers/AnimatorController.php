<?php

namespace App\Http\Controllers;

use App\Models\Animater;
use App\Models\Utilisator;
use Illuminate\Http\Request;

class AnimatorController extends Controller
{
    public function index(){
        $animators = Animater::all();
        return response()->json([
            "animators"=>$animators
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:animaters,email|unique:utilisators,email',
            'telephone' => 'required|string|max:20',
            'password' => 'nullable|string|min:6'
        ]);

        $password = $validated['password'] ?? 'trainer123';
        unset($validated['password']);

        // Generate username purely from prenom and nom, making it unique if needed
        $baseUsername = strtolower($validated['prenom'] . '_' . $validated['nom']);
        $generatedUsername = $baseUsername;
        $counter = 1;
        while (Utilisator::where('username', $generatedUsername)->exists()) {
            $generatedUsername = $baseUsername . '_' . $counter;
            $counter++;
        }

        // Create the corresponding formateur login account
        $utilisator = Utilisator::create([
            'username' => $generatedUsername,
            'email' => $validated['email'],
            'password' => bcrypt($password),
            'role' => 'formateur'
        ]);

        $validated['utilisator_id'] = $utilisator->id;
        $animater = Animater::create($validated);

        return response()->json([
            'message' => 'Animator added successfully',
            'data' => $animater
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $animater = Animater::findOrFail($id);
        $oldEmail = $animater->email;
        
        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'email' => 'email|unique:animaters,email,' . $id . '|unique:utilisators,email,' . ($animater->utilisator_id ?? 0),
            'telephone' => 'string|max:20',
            'password' => 'nullable|string|min:6'
        ]);

        $password = $validated['password'] ?? null;
        unset($validated['password']);

        $animater->update($validated);

        // Update corresponding login account
        $utilisator = Utilisator::where('email', $oldEmail)->where('role', 'formateur')->first();
        if ($utilisator) {
            $updates = [];
            if (isset($validated['email']) && $oldEmail !== $validated['email']) {
                $updates['email'] = $validated['email'];
            }
            if ($password) {
                $updates['password'] = bcrypt($password);
            }
            // Update username if name or lastname changes
            if (isset($validated['prenom']) || isset($validated['nom'])) {
                $prenom = $validated['prenom'] ?? $animater->prenom;
                $nom = $validated['nom'] ?? $animater->nom;
                $baseUsername = strtolower($prenom . '_' . $nom);
                $generatedUsername = $baseUsername;
                $counter = 1;
                while (Utilisator::where('username', $generatedUsername)->where('id', '!=', $utilisator->id)->exists()) {
                    $generatedUsername = $baseUsername . '_' . $counter;
                    $counter++;
                }
                $updates['username'] = $generatedUsername;
            }
            if (!empty($updates)) {
                $utilisator->update($updates);
            }
        }

        return response()->json([
            'message' => 'Animator updated successfully',
            'data' => $animater
        ]);
    }

    public function destroy(string $id)
    {
        $animater = Animater::findOrFail($id);
        
        // Delete the corresponding login account
        $utilisator = Utilisator::where('email', $animater->email)->where('role', 'formateur')->first();
        if ($utilisator) {
            $utilisator->delete();
        }

        $animater->delete();

        return response()->json(['message' => 'Animator deleted successfully']);
    }
}
