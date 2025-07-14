<?php require('connect.php');


function inscrire($nom, $mdp, $datedenaissance, $genre, $mail, $ville, $image)
{
    $base = connection();
    if ($base) {
        $requete1 = "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND date_naissance='$datedenaissance' AND genre='$genre' AND mail='$mail' AND ville='$ville'";
        $exe1 = mysqli_query($base, $requete1);

        if (mysqli_num_rows($exe1) == 0) {
            $requete = "INSERT INTO em_membre (nom, mdp, date_naissance, genre, mail, ville, image_profil)
                        VALUES ('$nom', '$mdp', '$datedenaissance', '$genre', '$mail', '$ville', '$image')";
            $exe = mysqli_query($base, $requete);
            if ($exe) {
                $query = "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND mail='$mail'";
                $ex = mysqli_query($base, $query);
                if ($ex) {
                    $row = mysqli_fetch_assoc($ex);
                    return $row['idmembre'];
                }
            } else {
                return false;
            }
        } else {
            return -1;
        }
    }
}


function getid($id)
{
    $requete="SELECT * FROM em_membre WHERE idmembre='$id'";
    $exe=mysqli_query(connection(),$requete);
    if(mysqli_num_rows($exe)>0)
    {
        $x=mysqli_fetch_assoc($exe);
        return $x;
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

function filtrer($categorie)
{
    $base=connection();
    $requete="SELECT * FROM v_objet_emprunt WHERE nom_categorie='$categorie'";
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

function upload_image( $files )
{
    $uploadDir = __DIR__ . '/../assets/uploads/';
    $maxSize = 2 * 1024 * 1024;
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($files))
    {
        $file = $files;

        if ($file['error'] !== UPLOAD_ERR_OK)
        {
            die('Erreur lors de l’upload : ' . $file['error']);
        }

        if ($file['size'] > $maxSize)
        {
            die('Le fichier est trop volumineux.');
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if ( !in_array($mime, $allowedMimeTypes) )
        {
            die('Type de fichier non autorisé : ' . $mime);
        }

        $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = $originalName . '_' . uniqid() . '.' . $extension;

        if( move_uploaded_file( $file['tmp_name'], $uploadDir . $newName ) )
        {
            return $newName;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return -1;
    }
}

function insert_image( $id_objet, $name )
{
    if ($base=connection())
    {
        $query="INSERT INTO em_objet_image ( id_objet, image_objet ) VALUES ( '$id_objet', '$name' )";
        $exe=mysqli_query($base,$query);
        echo $query;
        if ($exe)
        {
            return true;
        }
    }

    return false;
}


function get_object_info( $id_objet )
{
    if ($base=connection())
    {
        $query="SELECT * FROM v_object_and_images WHERE id_objet='$id_objet'";
        $exe=mysqli_query($base,$query);
        $row=array();

        if ($exe)
        {
            while ($data=mysqli_fetch_assoc($exe))
            {
                $row[]=$data;
            }
        }
    }

    return $row;
}

function get_objet( $id_objet )
{
    if ($base=connection())
    {
        $query="SELECT * FROM em_objet WHERE id_objet='$id_objet'";
        $exe=mysqli_query($base,$query);

        if ($exe)
        {
            $row=mysqli_fetch_assoc($exe);
        }
    }

    return $row;
}


function get_historique( $id )
{
    if ($base=connection())
    {
        $query="SELECT * FROM v_objet_emprunt WHERE id_objet='$id'";
        $exe=mysqli_query($base,$query);
        $data=array();

        if ($exe)
        {
            while ($row=mysqli_fetch_assoc($exe))
            {
                $data[] = $row;
            }
        }
    }

    return $data;
}


function get_objet_membre( $id )
{
    if ($base=connection())
    {
        $query="SELECT * FROM v_objet_emprunt WHERE idmembre='$id'";
        $exe=mysqli_query($base,$query);
        $data=array();

        if ($exe)
        {
            while ($row=mysqli_fetch_assoc($exe))
            {
                $data[] = $row;
            }
        }
    }

    return $data;
}

function get_membre( $id )
{
    if ($base=connection())
    {
        $query="SELECT *, TIMESTAMPDIFF( year, date_naissance, NOW()) age FROM em_membre WHERE idmembre='$id'";
        $exe=mysqli_query($base,$query);

        if ($exe)
        {
            $row=mysqli_fetch_assoc($exe);
        }
    }

    return $row;
}


?>
