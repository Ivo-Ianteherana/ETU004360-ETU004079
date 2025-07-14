<?php
require ('../inc/function.php');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INSCRIPTION</title>
</head>
<body>

<form action="traitementinscription.php" method="post" enctype="multipart/form-data">
    <input type="text" name="nom" placeholder="nom">
    <input type="date" name="dtn" placeholder="Date de naissance">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="mdp" placeholder="Mot de passe">

    <select name="genre">
        <option value="">Sélectionnez votre genre</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>

    </select>

    <input type="text" name="ville" placeholder="Ville">
    <input type="file" name="image">
    <input type="submit" value="inscription">
    <p>     aaa</p>

</form>
</body>
</html>