@extends('layouts.app')

@section('title','Ajouter Étudiant')

@section('content')
<div class="card">
	<h2>Ajouter Étudiant</h2>
	<form action="{{ route('etudiants.store') }}" method="POST">
		@csrf
		<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:10px">
			<input type="text" name="nom" placeholder="Nom" required>
			<input type="text" name="prenoms" placeholder="Prénoms" required>
			<input type="date" name="dateNaissance" required>
			<input type="text" name="adresse" placeholder="Adresse" required>
		</div>
		<div style="margin-top:12px">
			<button class="btn" type="submit">Ajouter</button>
			<a class="btn secondary" href="{{ route('etudiants.index') }}">Retour</a>
		</div>
	</form>
</div>
@endsection