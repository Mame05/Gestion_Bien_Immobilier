@extends('admin.layout')

@section('content')
    <h2>Modifier l'agence</h2>

    <form action="{{ route('admin.agences.update', $agence) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $agence->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $agence->telephone) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $agence->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $agence->adresse) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('admin.agences.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
