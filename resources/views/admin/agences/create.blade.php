@extends('admin.layout')

@section('content')
<h2>Créer une nouvelle agence</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.agences.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Téléphone</label>
        <input type="text" name="telephone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Adresse</label>
        <input type="text" name="adresse" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Utilisateur associé (user_id)</label>
        <select name="user_id" class="form-control" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->nom }} ({{ $user->email }})</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
@endsection
