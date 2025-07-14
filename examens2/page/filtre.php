<?php
require ('../inc/function.php');
session_start();
$sessid=$_SESSION['id'];
if(isset($_GET['categorie'])) $categorie=$_GET['categorie'];

$filtre=filtrer($categorie);
$resultCount = count($filtre);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filtre </title>
    <link rel="stylesheet" href="../assets/filtre.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="navigation-buttons">
    <a href="connexion.php" class="btn btn-primary">Se déconnecter</a>
    <a href="home.php" class="btn btn-primary">Accueil</a>
</div>

<div class="filter-container">

    <div class="page-header">
        <h1 class="page-title">Filtre par Catégorie</h1>

        <div class="user-info">
            <img src="../assets/uploads/<?php echo htmlspecialchars(getid($sessid)['image_profil']); ?>"
                 alt="Photo de profil" class="user-avatar">
            <div class="user-details">
                <h3>Connecté en tant que</h3>
                <p><?php echo htmlspecialchars(getid($sessid)['nom']); ?></p>
            </div>
        </div>
    </div>

    <div class="filter-info">
        <h4>    Filtrage actuel</h4>
        <p>Vous consultez tous les objets de la catégorie :</p>
        <span class="category-badge"><?php echo htmlspecialchars($categorie); ?></span>
    </div>

    <div class="results-summary">
        <div class="results-count"><?php echo $resultCount; ?> résultat(s) trouvé(s)</div>
        <div class="results-text">dans la catégorie "<?php echo htmlspecialchars($categorie); ?>"</div>
    </div>

    <?php if(empty($filtre)): ?>
        <div class="empty-state">
            <h3>Aucun objet trouvé</h3>
            <p>Il n'y a actuellement aucun objet dans la catégorie "<?php echo htmlspecialchars($categorie); ?>".</p>
            <p>Essayez de parcourir d'autres catégories ou revenez plus tard.</p>
            <a href="liste.php" class="back-button">Retour au catalogue</a>
        </div>
    <?php else: ?>
        <div class="objects-grid">
            <?php foreach ($filtre as $objet): ?>
                <div class="objet-card">
                    <div class="objet-header">
                        <div class="objet-nom"><?php echo htmlspecialchars($objet['nom_objet']); ?></div>
                    </div>

                    <div class="objet-info">
                        <span class="info-label">Catégorie:</span>
                        <span class="info-value">
                            <span class="category-link"><?php echo htmlspecialchars($objet['nom_categorie']); ?></span>
                        </span>
                    </div>

                    <div class="owner-info">
                        <div class="owner-label">Propriétaire:</div>
                        <div class="owner-name"><?php echo htmlspecialchars($objet['nom']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <a href="home.php" class="back-button">Retour au catalogue complet</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>