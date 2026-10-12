<?php

namespace App\Http\Controllers;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
    'nom' => 'required',
    'prenoms' => 'required',
    'dateNaissance' => 'required|date',
    'adresse' => 'required',
    ]);
    Etudiant::create($request->all());
    return redirect()->route('etudiants.index')
    ->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        Log::info('EtudiantController@show called', ['param_id' => $etudiant->id ?? null]);
        $found = (bool) $etudiant;
        Log::info('Etudiant resolved in controller', ['found' => $found]);
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'dateNaissance' => 'required|date',
            'adresse' => 'required',
            ]);
            $etudiant->update($request->all());
            return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiants.index')
        ->with('success', 'Étudiant supprimé avec succès.');
    }
}
