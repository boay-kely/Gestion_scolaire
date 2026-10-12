<!DOCTYPE html>
<html>
<head>
 <title>Liste des Étudiants</title>
</head>
<body>
 <h1>Liste des Étudiants</h1>
 <a href="{{ route('etudiants.create') }}">Ajouter un étudiant</a>
 @if(session('success'))
 <p style="color:green;">{{ session('success') }}</p>
 @endif
 <table border="1" cellpadding="5">
 <tr>
 <th>ID</th>
 <th>Nom</th>
 <th>Prénoms</th>
 <th>Date de Naissance</th>
 <th>Adresse</th>
 <th>Actions</th>
 </tr>
 @foreach($etudiants as $etudiant)
 <tr>
 <td>{{ $etudiant->id }}</td>
 <td>{{ $etudiant->nom }}</td>
 <td>{{ $etudiant->prenoms }}</td>
 <td>{{ $etudiant->dateNaissance }}</td>
 <td>{{ $etudiant->adresse }}</td>
 <td>
 <a href="{{ route('etudiants.show', $etudiant) }}">Voir</a>
 <a href="{{ route('etudiants.edit', $etudiant) }}">Modifier</a>
 <form action="{{ route('etudiants.destroy', $etudiant) }}" 
method="POST" style="display:inline;">
 @csrf
 @method('DELETE')
 <button type="submit" onclick="return 
confirm('Supprimer ?')">Supprimer</button>
 </form>
 </td>
 </tr>
 @endforeach
 </table>
</body>
</html>