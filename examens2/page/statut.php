<?php
    require ("../inc/function.php");
    session_start();

    if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['objet_no']))
    {
        $object=$_POST['objet_no'];
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
    <h1>Voulez vous emprunter cet objet ?</h1>

    <form action="home.php" method="get">
        <input type="number" name="nombre" />
        <input type="hidden" name="objet_n" value="<?php echo $object; ?>">
        <input type="submit" value="entrer">
    </form>
</body>
</html>


