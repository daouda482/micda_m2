@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2><i class="fas fa-edit"></i> Modifier le Recruteur</h2>
    <form action="{{ route('recruteurs.update', $recruiter) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.recruteurs.form')
        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save"></i> Mettre à jour</button>
    </form>
</div>
@endsection
