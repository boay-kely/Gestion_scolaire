<h1>Ajouter un Étudiant</h1>
<form action="{{ route('etudiants.store') }}" method="POST">
 @csrf
 <label>Nom :</label>
 <input type="text" name="nom"><br>
 <label>Prénoms :</label>
 <input type="text" name="prenoms"><br>
 <label>Date de Naissance :</label>
 <input type="date" name="dateNaissance"><br>
 <label>Adresse :</label>
 <input type="text" name="adresse"><br>
 <button type="submit">Enregistrer</button>
</form>
<a href="{{ route('etudiants.index') }}">Retour</a