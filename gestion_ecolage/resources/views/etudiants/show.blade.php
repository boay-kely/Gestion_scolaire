@extends('layouts.app')

@section('title','Détails Étudiant')

@section('content')
<div class="card">
	<h2>Détails Étudiant</h2>
	<div style="margin-top:12px">
		<p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
		<p><strong>Prénoms :</strong> {{ $etudiant->prenoms }}</p>
		<p><strong>Date de Naissance :</strong> {{ $etudiant->dateNaissance }}</p>
		<p><strong>Adresse :</strong> {{ $etudiant->adresse }}</p>
		<a class="btn secondary" href="{{ route('etudiants.index') }}">Retour</a>
	</div>
</div>
@endsection