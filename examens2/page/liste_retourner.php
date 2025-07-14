<?php
require('../inc/function.php');

$base = connection();
$retours = [];

if ($base) {
    $query = "SELECT r.*, m.nom AS nom_membre 
              FROM em_retour r 
              JOIN em_membre m ON r.id_membre = m.idmembre 
              ORDER BY r.id_retour DESC";
    $exe = mysqli_query($base, $query);

    if ($exe) {
        while ($row = mysqli_fetch_assoc($exe)) {
            $retours[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Retours</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h1 class="mb-4">Objets retournés</h1>
<?php if (empty($retours)): ?>
    <div class="alert alert-info">Aucun objet retourné.</div>
<?php else: ?>
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Membre</th>
            <th>Objet</th>
            <th>Catégorie</th>
            <th>Date d'emprunt</th>
            <th>Date de retour</th>
            <th>État</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($retours as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['nom_membre']); ?></td>
                <td><?= htmlspecialchars($r['nom_objet']); ?></td>
                <td><?= htmlspecialchars($r['nom_categorie']); ?></td>
                <td><?= htmlspecialchars($r['date_emprunt']); ?></td>
                <td><?= htmlspecialchars($r['date_retour']); ?></td>
                <td>
                    <?= $r['etat'] === 'ok' ? '✅ OK' : '⚠️ Abîmé'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<a href="home.php" class="btn btn-primary">Retour à l'accueil</a>
</body>
</html>
