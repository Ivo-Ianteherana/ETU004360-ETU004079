<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../inc/function.php');

session_start();
if (isset($_SESSION['id'])) {
    $idM = $_SESSION['id'];
}
$objets = listerobjet();

// Compteurs pour les statistiques
$totalObjects = count($objets);
$availableObjects = 0;
$borrowedObjects = 0;

foreach ($objets as $objet) {
    if ($objet['date_emprunt'] != null) {
        $borrowedObjects++;
    } else {
        $availableObjects++;
    }
}
if (isset($_GET['objet_n']) && isset($_GET['nbr']))
{
    $ob = get_objet($_GET['objet_n']);
    $availability = $ob['id_objet'];
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Objets - Plateforme de Partage</title>
    <link rel="stylesheet" href="../assets/liste.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="navigation-buttons">
    <a href="connexion.php" class="btn btn-primary">Se déconnecter</a>
    <a href="home.php" class="btn btn-primary">Accueil</a>
</div>

<div class="page-header">
    <h1 class="page-title">Catalogue des Objets</h1>
    <p class="page-subtitle">Découvrez tous les objets partagés par notre communauté</p>

    <div class="user-info">
        <img src="../assets/uploads/<?php echo htmlspecialchars(getid($idM)['image_profil']); ?>"
             alt="Photo de profil" class="user-avatar">
        <div class="user-details">
            <h3>Bonjour, <?php echo htmlspecialchars(getid($idM)['nom']); ?></h3>
            <p>Membre de la communauté de partage</p>
        </div>
    </div>
</div>

<div class="stats-bar">
    <div class="stat-item">
        <span class="stat-number"><?php echo $totalObjects; ?></span>
        <span class="stat-label">Objets Total</span>
    </div>
    <div class="stat-item">
        <span class="stat-number"><?php echo $availableObjects; ?></span>
        <span class="stat-label">Disponibles</span>
    </div>
    <div class="stat-item">
        <span class="stat-number"><?php echo $borrowedObjects; ?></span>
        <span class="stat-label">Empruntés</span>
    </div>
</div>

<div class="container">
    <?php if (empty($objets)): ?>
        <div class="empty-state">
            <h3>Aucun objet disponible</h3>
            <p>Il n'y a actuellement aucun objet partagé dans la communauté. Soyez le premier à partager un objet !</p>
        </div>
    <?php else: ?>
        <div class="objects-grid">
            <?php foreach ($objets as $objet): ?>
                <div class="objet-card">
                    <div class="objet-nom"><a href="fiche_membre.php?m_no=<?php echo $objet['idmembre']; ?>"><?php echo htmlspecialchars($objet['nom']); ?></a></div>

                    <div class="objet-info">
                        <span class="info-label">Catégorie:</span>
                        <span class="info-value">
                            <a href="filtre.php?categorie=<?php echo urlencode($objet['nom_categorie']); ?>"
                               class="category-link">
                                <?php echo htmlspecialchars($objet['nom_categorie']); ?>
                            </a>
                        </span>
                    </div>

                    <div class="objet-info">
                        <span class="info-label">Nom:</span>
                        <span class="info-value">
                            <a href="fiche_objet.php?objet_no=<?php echo $objet['id_objet']; ?>">
                                <?php echo htmlspecialchars($objet['nom_objet']); ?>
                            </a>
                        </span>
                    </div>

                    <div class="objet-info">
                        <span class="info-label">Status:</span>
                        <span class="info-value">
                            <?php if ($objet['date_emprunt'] != null): ?>
                                <span class="status-badge status-borrowed">
                                    Emprunté jusqu'au <?php echo htmlspecialchars($objet['date_retour']); ?>
                                </span>
                            <?php else: ?>
                                <span class="status-badge status-available">
                                    Disponible
                                </span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div>
                        <p>Statut:</p>
                        <?php
                            if (isset($availability))
                            {
                                if ($availability==$objet['id_objet'])
                                { ?>
                                    <p>Disponible dans <?= $_GET['nbr']; ?> jours</p>
                                <?php}
                                else { ?>
                                    <p>Disponible</p>
                                <?php }
                            }
                            else
                            { ?>
                                <p>Disponible</p>
                            <?php }
                        ?>

                    </div>

                    <form action="traitementimage.php" method="post" enctype="multipart/form-data" class="upload-form">
                        <input type="file" name="objet_image" accept="image/*">
                        <input type="hidden" name="id_objet" value="<?= $objet['id_objet']; ?>">
                        <input type="submit" value="Ajouter une image">
                    </form>

                    <form action="statut.php" method="post">
                        <input type="hidden" name="id_objet" value="<?= $objet['id_objet']; ?>">
                        <input type="submit" value="Emprunter">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>