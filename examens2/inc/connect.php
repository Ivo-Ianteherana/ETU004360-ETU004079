<?php

function connection()
{
    $base = mysqli_connect("localhost", "root", "", "emprunt");
    if (!$base) {
        die("Erreur :");
    }
    return $base;
}


?>
