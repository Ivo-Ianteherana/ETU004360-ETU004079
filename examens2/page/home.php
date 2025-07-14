<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    require ('../inc/function.php');

    session_start();
    if(isset($_SESSION['id']))
    {
        $idM=$_SESSION['id'];
    }
    $objets=listerobjet();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>
        <?php
        foreach ($objets as $objet)
        {
            echo $objet['nom'];
            echo $objet['nom_categorie'];
            echo $objet['nom_objet'];
            if($objet['date_emprunt'] != null)
            {
                echo $objet['date_retour'];
            }
            else {
                echo "Pas d'emprunt";
            }
        }

        ?>
</body>
</html>
