<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\User;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function dashboard()
    {
        return view('agence.dashboard');
    }
    public function index()
    {
        $agences = Agence::with('user')->get();
        return view('admin.agences.index', compact('agences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $users = User::where('role', 'agence')->get(); // ou tous si besoin
        return view('admin.agences.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:agences,email',
            'adresse' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Le user lié (souvent une agence)
        ]);

        // Création de l'agence
        Agence::create($validated);

        // Redirection avec message de succès
        return redirect()->route('admin.agences.index')->with('success', 'Agence créée avec succès.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Agence $agence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agence $agence)
    {
        return view('admin.agences.edit', compact('agence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agence $agence)
    {
        $request->validate([
        'nom' => 'required|string|max:255',
        'telephone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'adresse' => 'required|string|max:255',
        ]);

        $agence->update($request->only(['nom', 'telephone', 'email', 'adresse']));

        return redirect()->route('admin.agences.index')->with('success', 'Agence modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agence $agence)
    {
        $agence->delete();
        return redirect()->route('admin.agences.index')->with('success', 'Agence supprimée avec succès.');
    }
}
