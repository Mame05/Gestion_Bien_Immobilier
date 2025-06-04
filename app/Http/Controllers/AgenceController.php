<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\User;
use App\Notifications\AgenceCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|unique:agences,email',
            'adresse' => 'required|string|max:255',
        ]);

        // Génération d'un mot de passe aléatoire
        $motDePasse = Str::random(10);

        // Création de l'utilisateur associé
        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($motDePasse),
            'role' => 'agence',
        ]);

        // Création de l'agence liée à l'utilisateur
        Agence::create([
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'user_id' => $user->id,
        ]);

        // 👉 Envoyer la notification avec le mot de passe
        $user->notify(new AgenceCreated($motDePasse));

        // Message succès
        return redirect()->route('admin.agences.index')->with('success', "Agence créée avec succs et identifiants envoyés.");
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
