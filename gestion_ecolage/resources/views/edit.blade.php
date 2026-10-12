<h1>Modifier Étudiant</h1>
<form action="{{ route('etudiants.update', $etudiant) }}" 
method="POST">
 @csrf
 @method('PUT')
 <label>Nom :</label>
 <input type="text" name="nom" value="{{ $etudiant->nom }}"><br>
 <label>Prénoms :</label>
 <input type="text" name="prenoms" value="{{ $etudiant->prenoms 
}}"><br>
<label>Date de Naissance :</label>
 <input type="date" name="dateNaissance" value="{{ $etudiant-
>dateNaissance }}"><br>
 <label>Adresse :</label>
 <input type="text" name="adresse" value="{{ $etudiant->adresse 
}}"><br>
 <button type="submit">Mettre à jour</button>
</form>
<a href="{{ route('etudiants.index') }}">Retour</a>
show.blade.php
<h1>Détails Étudiant</h1>
<p><strong>Nom :</strong> {{ $etudiant->nom }}</p>
<p><strong>Prénoms :</strong> {{ $etudiant->prenoms }}</p>
<p><strong>Date de Naissance :</strong> {{ $etudiant-
>dateNaissance }}</p>
<p><strong>Adresse :</strong> {{ $etudiant->adresse }}</p>
<a href="{{ route('etudiants.index') }}">Retour</a> 