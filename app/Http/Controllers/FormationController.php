<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::with(['animateurs', 'themes'])->get();
 
        return response()->json([
            "formations"=>$formations
        ]);
    }

    public function formationsAnimateur($id)
{
    $formations = Formation::whereHas(
        'animateurs',
        function ($query) use ($id) {
            $query->where('users.id', $id);
        }
    )
    ->withCount('stagiaires')
    ->get();

    return response()->json([
        'formations' => $formations
    ]);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Formation::create($data);

        return response()->json([
            "created"=>"has been created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = request('formation');
        $data = $request->all();
        $form = Formation::find($id);
        $form->update($data);
        return response()->json([
            "updated"=>"has been updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = request('formation');
        $form = Formation::find($id);

        $form->delete();
    }
}
