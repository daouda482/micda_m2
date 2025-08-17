@extends('admin.layout')

@section('content')
<h2>Gestion des candidats</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidates as $candidate)
        <tr>
            <td>{{ $candidate->id }}</td>
            <td>{{ $candidate->name }}</td>
            <td>{{ $candidate->email }}</td>
            <td>{{ ucfirst($candidate->status ?? 'pending') }}</td>
            <td>
                <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Voir</a>
                <form action="{{ route('admin.candidates.updateStatus', $candidate->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="accepted">
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Accepter ce candidat ?')"><i class="fas fa-check"></i></button>
                </form>
                <form action="{{ route('admin.candidates.updateStatus', $candidate->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Rejeter ce candidat ?')"><i class="fas fa-times"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
