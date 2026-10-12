<?php

namespace App\Http\Controllers;

use App\Models\ParentGuardian;
use Illuminate\Http\Request;

class ParentGuardianController extends Controller
{
    /**
     * Display a listing of parents.
     */
    public function index(Request $request)
    {
        $query = ParentGuardian::query();
        
        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        $parents = $query->paginate(7);
        return view('parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new parent.
     */
    public function create()
    {
        return view('parents.create');
    }

    /**
     * Store a newly created parent in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:parents',
            'phone' => 'required|string|max:20',
            'phone_secondary' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'occupation' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:100',
            'annual_income' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        ParentGuardian::create($validated);

        return redirect(route('parents.index'))->with('success', 'Parent créé avec succès.');
    }

    /**
     * Display the specified parent.
     */
    public function show(ParentGuardian $parent)
    {
        return view('parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified parent.
     */
    public function edit(ParentGuardian $parent)
    {
        return view('parents.edit', compact('parent'));
    }

    /**
     * Update the specified parent in storage.
     */
    public function update(Request $request, ParentGuardian $parent)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:parents,email,' . $parent->id,
            'phone' => 'required|string|max:20',
            'phone_secondary' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'occupation' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:100',
            'annual_income' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $parent->update($validated);

        return redirect(route('parents.index'))->with('success', 'Parent modifié avec succès.');
    }

    /**
     * Remove the specified parent from storage.
     */
    public function destroy(ParentGuardian $parent)
    {
        $parent->delete();
        return redirect(route('parents.index'))->with('success', 'Parent supprimé avec succès.');
    }
}
