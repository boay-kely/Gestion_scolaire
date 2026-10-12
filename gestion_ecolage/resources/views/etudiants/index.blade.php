<!DOCTYPE html>
<html>
<head>
 <title>Liste des Étudiants</title>
 @if (file_exists(resource_path('css/app.css')))
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
 @endif
</head>
<body>
<div class="container">
	<div class="card">
		<div class="toolbar">
			<h1>Liste des Étudiants</h1>
			<div class="search">
				<input id="search" type="search" placeholder="Rechercher...">
			</div>
			<a class="btn" href="{{ route('etudiants.create') }}">Ajouter</a>
		</div>

		@if(session('success'))
		<p class="muted">{{ session('success') }}</p>
		@endif

		<div class="table-responsive">
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Prénoms</th>
						<th>Date de Naissance</th>
						<th>Adresse</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				@foreach($etudiants as $etudiant)
					<tr>
						<td>{{ $etudiant->id }}</td>
						<td>{{ $etudiant->nom }}</td>
						<td>{{ $etudiant->prenoms }}</td>
						<td>{{ $etudiant->dateNaissance }}</td>
						<td>{{ $etudiant->adresse }}</td>
						<td class="actions">
							<a class="btn secondary" href="{{ route('etudiants.show', $etudiant) }}">Voir</a>
							<a class="btn" href="{{ route('etudiants.edit', $etudiant) }}">Modifier</a>
							<form data-confirm="Voulez-vous vraiment supprimer cet étudiant ?" action="{{ route('etudiants.destroy', $etudiant) }}" method="POST" style="display:inline;">
								@csrf
								@method('DELETE')
								<button class="btn secondary" type="submit">Supprimer</button>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@if (file_exists(resource_path('js/app.js')))
	<script src="{{ asset('js/app.js') }}"></script>
@endif
</body>
</html>