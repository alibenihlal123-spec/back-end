<?php

namespace App\Http\Controllers;

use App\Models\Participent;
use App\Models\Utilisator;
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
            'email' => 'required|email|unique:participents,email|unique:utilisators,email',
            'password' => 'nullable|string|min:6'
        ]);

        $password = $validated['password'] ?? 'client123';
        unset($validated['password']);

        // Generate username purely from prenom and nom, making it unique if needed
        $baseUsername = strtolower($validated['prenom'] . '_' . $validated['nom']);
        $generatedUsername = $baseUsername;
        $counter = 1;
        while (Utilisator::where('username', $generatedUsername)->exists()) {
            $generatedUsername = $baseUsername . '_' . $counter;
            $counter++;
        }

        // Create the corresponding client login account first
        $utilisator = Utilisator::create([
            'username' => $generatedUsername,
            'email' => $validated['email'],
            'password' => bcrypt($password),
            'role' => 'client'
        ]);

        $validated['utilisator_id'] = $utilisator->id;
        $participent = Participent::create($validated);

        return response()->json([
            'message' => 'Participant added successfully',
            'data' => $participent
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $participent = Participent::findOrFail($id);
        $oldEmail = $participent->email;
        
        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prenom' => 'string|max:255',
            'email' => 'email|unique:participents,email,' . $id . '|unique:utilisators,email,' . ($participent->utilisator_id ?? 0),
            'password' => 'nullable|string|min:6'
        ]);

        $password = $validated['password'] ?? null;
        unset($validated['password']);

        $participent->update($validated);

        // Update corresponding login account
        $utilisator = Utilisator::where('email', $oldEmail)->where('role', 'client')->first();
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
                $prenom = $validated['prenom'] ?? $participent->prenom;
                $nom = $validated['nom'] ?? $participent->nom;
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
            'message' => 'Participant updated successfully',
            'data' => $participent
        ]);
    }

    public function destroy(string $id)
    {
        $participent = Participent::findOrFail($id);
        
        // Delete the corresponding login account
        $utilisator = Utilisator::where('email', $participent->email)->where('role', 'client')->first();
        if ($utilisator) {
            $utilisator->delete();
        }

        $participent->delete();

        return response()->json(['message' => 'Participant deleted successfully']);
    }
}

