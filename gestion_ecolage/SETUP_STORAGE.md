# Configuration du Stockage des Images

## Problème
Les images uploadées ne s'affichent pas correctement dans le profil étudiant.

## Solution

### 1. **Via la route Laravel** (RECOMMANDÉ)
Une route spéciale a été ajoutée à `routes/web.php` pour servir les images directement.
Les images sont maintenant accessibles via: `/storage/{path}`

### 2. **Créer un lien symbolique** (OPTIONNEL)
Si vous voulez accéder directement aux fichiers via `asset('storage/...')`, créez un lien symbolique:

```bash
# Depuis le répertoire racine du projet
php artisan storage:link
```

Cela créera un lien de `public/storage` vers `storage/app/public`.

### 3. **Permissions des fichiers**
Les permissions des fichiers sont automatiquement définies à 0644 lors de l'upload.

## Structure des dossiers

```
storage/
  └── app/
      └── public/
          └── students/        (Photos des étudiants)
              ├── photo1.jpg
              ├── photo2.png
              └── ...
```

## Tests

1. Créer un nouvel étudiant avec une photo
2. Aller au profil de l'étudiant
3. La photo doit s'afficher en cercle
4. Cliquer sur la photo pour voir en grand (lightbox)

## Dépannage

Si la photo ne s'affiche toujours pas:

1. Vérifier que le dossier `storage/app/public/students` existe
2. Vérifier que le fichier image existe physiquement
3. Vérifier les permissions du dossier `storage` (doit être inscriptible par le serveur web)
4. Vérifier les logs Laravel dans `storage/logs/laravel.log`

## Documentation

- [Laravel Filesystem](https://laravel.com/docs/9.x/filesystem)
- [Laravel Storage Symbolic Links](https://laravel.com/docs/9.x/filesystem#the-public-disk)
