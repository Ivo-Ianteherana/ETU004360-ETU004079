<?php require('connect.php');


function inscrire($nom ,$mdp,$datedenaissance,$genre,$mail,$ville)
{
    $base=connection();
    if($base)
    {
        $x =array();
        $requete1= "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND date_naissance='$datedenaissance' AND genre='$genre' AND mail='$mail' AND ville='$ville' ";
        $exe1 = mysqli_query($base, $requete1);

        if(mysqli_num_rows($exe1)==0)
        {
            $requete = "INSERT INTO em_membre (nom,mdp,date_naissance,genre,mail,ville) VALUES ('$nom','$mdp','$datedenaissance','$genre','$mail','$ville')";
            $exe = mysqli_query($base, $requete);
            if($exe)
            {
                $query="SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND mail='$mail'";
                $ex=mysqli_query($base,$query);

                if ($ex)
                {
                    $row=mysqli_fetch_assoc($ex);
                    return $row['idmembre'];
                }
            }
            else return false;
        }
        else if (mysqli_num_rows($exe1)>0)
        {
            return -1;
        }

    }
}
function getid($nom ,$mdp,$datedenaissance,$genre,$mail,$ville)
{
    $requete="SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND date_naissance='$datedenaissance' AND genre='$genre' AND mail='$mail' AND ville='$ville'";
    $exe=mysqli_query(connection(),$requete);
    if(mysqli_num_rows($exe)>0)
    {
        $x=mysqli_fetch_assoc($exe);
        return $x['id'];
    }
    else return false;
}



function login($mdp,$email)
{
    if($base=connection())
    {
        $requete="SELECT * FROM em_membre WHERE mdp='$mdp' AND mail='$email'";
        $exe=mysqli_query($base,$requete);
        if(mysqli_num_rows($exe)>0)
        {
            $row=mysqli_fetch_assoc($exe);
        return $row['idmembre'];
        }

        else return false;


    }
}

function listerobjet()
{
    $base=connection();
    $requete="SELECT * FROM v_objet_emprunt";
    $exe=mysqli_query($base,$requete);
    $row=array();

    if($exe)
    {
        while($x=mysqli_fetch_assoc($exe))
        {
            $row[]=$x;
        }
        return $row;
    }
    else return false;
}


?>
