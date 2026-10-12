@extends('layouts.app')

@section('title','Modifier Étudiant')

@section('content')
<div class="card">
	<h2>Modifier Étudiant</h2>
	<form action="{{ route('etudiants.update', $etudiant) }}" method="POST">
		@csrf
		@method('PUT')
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:10px">
			<input type="text" name="nom" value="{{ $etudiant->nom }}" required>
			<input type="text" name="prenoms" value="{{ $etudiant->prenoms }}" required>
			<input type="date" name="dateNaissance" value="{{ $etudiant->dateNaissance }}" required>
			<input type="text" name="adresse" value="{{ $etudiant->adresse }}" required>
		</div>
		<div style="margin-top:12px">
			<button class="btn" type="submit">Mettre à jour</button>
			<a class="btn secondary" href="{{ route('etudiants.index') }}">Retour</a>
		</div>
	</form>
</div>
@endsection