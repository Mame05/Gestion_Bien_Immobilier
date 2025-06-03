@extends('admin.layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des agences</h2>
        <a href="{{ route('admin.agences.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Ajouter une agence
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Responsable (User)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($agences as $agence)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $agence->nom }}</td>
                    <td>{{ $agence->email }}</td>
                    <td>{{ $agence->telephone }}</td>
                    <td>{{ $agence->adresse }}</td>
                    <td>{{ $agence->user->nom ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('admin.agences.edit', $agence) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.agences.destroy', $agence) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucune agence enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
