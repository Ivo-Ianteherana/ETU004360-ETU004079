<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require ('../inc/function.php');
if(isset($_GET['deja']))
{
echo '<p> Connecter vous plutot  </p>';
}
if(isset($_GET['error']))
{
    echo '<p>Réessayer</p>';
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONNEXION</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>

<form action="traitementconnexion.php" method="post">
    <input type="email" name="mail">
    <input type="password" name="mdp">
    <input type="submit" value="connexion">
</form>

<a href="inscription.php">S inscrire</a>
</body>
</html>
