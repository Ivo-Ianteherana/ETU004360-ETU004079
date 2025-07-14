<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ('../inc/function.php');

$alertMessage = '';
$typealert = '';

if(isset($_GET['deja']))
{
    $alertMessage = 'Vous devez vous connecter pour accéder à cette page.';
    $typealert = 'alert-info';
}
if(isset($_GET['error']))
{
    $alertMessage = 'Identifiants incorrects. Veuillez réessayer.';
    $typealert = 'alert-error';
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion </title>
    <link rel="stylesheet" href="../assets/connexion.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="login-container">
    <div class="login-header">
        <h1 class="login-title">Connexion</h1>
        <p class="login-subtitle">Accédez à votre espace personnel</p>
    </div>

    <div class="welcome-message">
        <h3>Bienvenue sur notre plateforme</h3>
        <p>Connectez-vous pour accéder à vos objets partagés et découvrir ce que votre communauté propose</p>
    </div>

    <?php if($alertMessage): ?>
        <div class="alert <?php echo $typealert; ?>">
            <?php echo $alertMessage; ?>
        </div>
    <?php endif; ?>

    <form action="traitementconnexion.php" method="post">
        <div class="form-group">
            <label class="form-label">Adresse e-mail</label>
            <input type="email" name="mail" class="form-input" placeholder="Entrez votre adresse e-mail" required>
        </div>

        <div class="form-group">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="mdp" class="form-input" placeholder="Entrez votre mot de passe" required>
        </div>

        <input type="submit" value="Se connecter" class="btn-primary">
    </form>

    <div class="divider">
        <span>ou</span>
    </div>

    <a href="inscription.php" class="auth-link">
        Pas encore de compte ? S'inscrire gratuitement
    </a>

    <div class="login-benefits">
        <h4>Pourquoi nous rejoindre ?</h4>
        <ul>
            <li>Partagez vos objets avec votre communauté</li>
            <li>Découvrez des objets disponibles près de chez vous</li>
            <li>Créez des liens avec vos voisins</li>
            <li>Contribuez à une économie circulaire</li>
        </ul>
    </div>
</div>

</body>
</html>