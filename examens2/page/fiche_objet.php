<?php
require('../inc/function.php');

if (isset($_GET["objet_no"])) {
    $result = get_object_info($_GET["objet_no"]);
    $row = get_objet($_GET["objet_no"]);
    $story = get_historique($_GET["objet_no"]);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche Objet - <?= htmlspecialchars($row["nom_objet"]); ?></title>
    <link rel="stylesheet" href="../assets/fiche_objet.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="page-container">
    <div class="page-header">
        <h1 class="object-title"><?= htmlspecialchars($row["nom_objet"]); ?></h1>
        <div class="info-badge">Fiche détaillée de l'objet</div>

        <?php if (!empty($row["nom_image"])){ ?>
            <img src="../assets/uploads/<?= htmlspecialchars($row["nom_image"]); ?>"
                 alt="Image principale de <?= htmlspecialchars($row["nom_objet"]); ?>"
                 class="main-image">

<        <?php  }
                else
                { ?>
                    <img src="../assets/uploads/default.png ">
              <?php  }
        ?>
    </div>

    <?php if (!empty($result)): ?>
        <div class="object-gallery">
            <?php foreach ($result as $key): ?>
                <div class="gallery-item">
                    <h3><?= htmlspecialchars($key["nom_objet"]); ?></h3>
                    <?php if (!empty($key['image_objet'])): ?>
                        <img src="../assets/uploads/<?= htmlspecialchars($key['image_objet']); ?>"
                             alt="Image de <?= htmlspecialchars($key["nom_objet"]); ?>"
                             class="gallery-image">
                    <?php else: ?>
                        <div class="gallery-image" style="background: var(--purple-bg); display: flex; align-items: center; justify-content: center; color: var(--medium-gray);">
                            Aucune image disponible
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="history-section">
        <h2 class="section-title">Historique des Emprunts</h2>

        <?php if (!empty($story)): ?>
            <table class="history-table">
                <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Date d'Emprunt</th>
                    <th>Date de Retour</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($story as $histoire): ?>
                    <tr>
                        <td><?= htmlspecialchars($histoire['nom_categorie']); ?></td>
                        <td><?= htmlspecialchars($histoire['date_emprunt'] ?: 'Non spécifiée'); ?></td>
                        <td><?= htmlspecialchars($histoire['date_retour'] ?: 'Non spécifiée'); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-history">
                <h3>Aucun historique disponible</h3>
                <p>Cet objet n'a pas encore d'historique d'emprunt enregistré.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="navigation-section">
        <a href="home.php" class="home-link">Retour à l'Accueil</a>
    </div>
</div>

</body>
</html>