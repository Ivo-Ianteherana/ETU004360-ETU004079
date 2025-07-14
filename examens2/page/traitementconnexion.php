<?php
require('../inc/function.php');
if(isset($_POST['mail']) && isset($_POST['mdp']))
{
    $mail=$_POST['mail'];
    $mdp=$_POST['mdp'];

    if(login($mdp,$mail))
    {
        header('Location: ../page/home.php');

    }
    else
    {
        header('Location: ../page/connexion.php?faux=1');;
    }
}

?>
