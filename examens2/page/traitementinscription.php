<?php
require ('../inc/function.php');
session_start();
if(isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['dtn']) && isset($_POST['genre']) && isset($_POST['email']) && isset($_POST['ville']) && isset($_FILES['image']))
{
    $nom=$_POST['nom'];
    $mdp=$_POST['mdp'];
    $dtn=$_POST['dtn'];
    $genre=$_POST['genre'];
    $mail=$_POST['email'];
    $ville=$_POST['ville'];
    $image=$_FILES['image'];

    $load = inscrire($nom, $mdp, $dtn, $genre, $mail, $ville, $image);

    if ($load !== false && $load !== -1) {
        $_SESSION['id'] = $load;
        header('Location: home.php');
    } elseif ($load === -1) {
        header('Location: ../page/connexion.php?deja=1');
    } else {
        header('Location: ../page/inscription.php?error=1');
    }


}




?>
