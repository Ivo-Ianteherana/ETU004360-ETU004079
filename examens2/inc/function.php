<?php require('connect.php');


function inscrire($nom ,$mdp,$datedenaissance,$genre,$mail,$ville,$image)
{
    $base=connection();
    if($base)
    {
        $x =array();
        $requete1= "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND date_naissance='$datedenaissance' AND genre='$genre' AND mail='$mail' AND ville='$ville' AND image='$image'";
        $exe1 = mysqli_query($base, $requete1);
        if(mysqli_num_rows($exe1)==0)
        {
            $requete = "INSERT INTO em_membre (nom,mdp,date_naissance,genre,mail,ville,image_profil) VALUES ('$nom','$mdp','$datedenaissance','$genre','$mail','$ville','$image','')";

            $exe = mysqli_query($base, $requete);
            if($exe)return true;
            else return false;
        }
        else if (mysqli_num_rows($exe1)>0)
        {
            return 2;
        }

    }
}



?>
