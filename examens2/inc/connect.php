<?php

function connection()
{
    $base = mysqli_connect("localhost", "ETU004360", "ihEqxtHr", "db_s2_ETU004360");
    //$base = mysqli_connect("localhost", "root", "", "emprunt");

    if (!$base) {
        die("Erreur :");
    }
    return $base;
}


?>
