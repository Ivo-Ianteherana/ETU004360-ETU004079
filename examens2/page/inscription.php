<?php
require('../inc/function.php');
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription - Plateforme de Partage</title>
    <link rel="stylesheet" href="../assets/inscription.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="auth-container">
    <div class="auth-header">
        <h1 class="auth-title">Inscription</h1>
        <p class="auth-subtitle">Rejoignez notre communauté de partage</p>
    </div>

    <div class="requirements">
        <h4>Informations requises :</h4>
        <ul>
            <li>Nom complet</li>
            <li>Date de naissance</li>
            <li>Adresse e-mail valide</li>
            <li>Mot de passe sécurisé</li>
            <li>Ville de résidence</li>
            <li>Photo de profil (optionnel)</li>
        </ul>
    </div>

    <form action="traitementinscription.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Nom complet</label>
            <input type="text" name="nom" class="form-input" placeholder="Entrez votre nom complet" required>
        </div>

        <div class="form-group">
            <label class="form-label">Date de naissance</label>
            <input type="date" name="dtn" class="form-input" required>
        </div>

        <div class="form-group">
            <label class="form-label">Adresse e-mail</label>
            <input type="email" name="email" class="form-input" placeholder="exemple@email.com" required>
        </div>

        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mdp" class="form-input" placeholder="Créez un mot de passe sécurisé" required>
        </div>

        <div class="form-group">
            <label class="form-label">Genre</label>
            <select name="genre" class="form-select" required>
                <option value="">Sélectionnez votre genre</option>
                <option value="H">Homme</option>
                <option value="F">Femme</option>
                <option value="A">Autre</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" class="form-input" placeholder="Votre ville de résidence" required>
        </div>

        <div class="form-group">
            <label class="form-label">Photo de profil (optionnel)</label>
            <div class="file-input-wrapper">
                <input type="file" name="image" id="image" accept="image/*">
                <label for="image" class="file-input-label">
                     Choisir une photo de profil
                </label>
            </div>
        </div>

        <input type="submit" value="Créer mon compte" class="btn-primary">
    </form>

    <a href="connexion.php" class="auth-link">
        Déjà un compte ? Se connecter
    </a>
</div>

</body>
</html>