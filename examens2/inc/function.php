<?php require('connect.php');
function upload_photo($file)
{
    // Vérification initiale du fichier
    if (!isset($file) || !is_array($file) || empty($file['tmp_name'])) {
        error_log("Données de fichier invalides");
        return null;
    }

    // Vérification si le fichier temporaire existe
    if (!file_exists($file['tmp_name'])) {
        error_log("Le fichier temporaire n'existe pas : " . $file['tmp_name']);
        return null;
    }

    $uploadDir = __DIR__ . '/../assets/uploads/';

    // Créer le dossier d'upload s'il n'existe pas
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            error_log("Impossible de créer le dossier d'upload");
            return null;
        }
    }

    // Configuration
    $maxSize = 50 * 1024 * 1024; // 50 Mo
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg' ];

    // Vérification des erreurs d'upload
    if ($file['error'] !== UPLOAD_ERR_OK) {
        error_log("Erreur d'upload code : " . $file['error']);
        return null;
    }

    // Vérification de la taille
    if ($file['size'] > $maxSize) {
        error_log("Fichier trop volumineux : " . $file['size'] . " octets");
        return null;
    }

    // Vérification du type MIME
    try {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        if (!in_array($mime, $allowedMimeTypes)) {
            error_log("Type de fichier non autorisé : " . $mime);
            return null;
        }
    } catch (Exception $e) {
        error_log("Erreur lors de la vérification du type MIME : " . $e->getMessage());
        return null;
    }

    // Génération du nouveau nom de fichier
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = preg_replace('/[^a-zA-Z0-9_-]/', '', $originalName); // Nettoie le nom
    $newName = $newName . '_' . uniqid() . '.' . $extension;
    $destination = $uploadDir . $newName;

    // Déplacement du fichier
    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        error_log("Échec du déplacement du fichier de {$file['tmp_name']} vers $destination");
        return null;
    }

    return $newName;
}

function login($mdp,$email)
{
    if($base=connection())
    {
        $requete="SELECT * FROM em_membre WHERE mdp='$mdp' AND mail='$email'";
        $exe=mysqli_query($base,$requete);
        if(mysqli_num_rows($exe)>0)
        {
            $id=mysqli_fetch_assoc($exe);
            return $id['idmembre'];
        }
        else{
            return false;
        }




    }
}
function inscrire($nom, $mdp, $datedenaissance, $genre, $mail, $ville, $image)
{
    $base = connection();
    if ($base) {
        $requete1 = "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND date_naissance='$datedenaissance' AND genre='$genre' AND mail='$mail' AND ville='$ville'";
        $exe1 = mysqli_query($base, $requete1);

        if (mysqli_num_rows($exe1) == 0) {

            $imageName = upload_photo($image);

            if ($imageName === null) {
                return false;
            }
            $requete = "INSERT INTO em_membre (nom, mdp, date_naissance, genre, mail, ville, image_profil)
                        VALUES ('$nom', '$mdp', '$datedenaissance', '$genre', '$mail', '$ville', '$imageName')";
            $exe = mysqli_query($base, $requete);

            if ($exe)
            {
                $query = "SELECT * FROM em_membre WHERE nom='$nom' AND mdp='$mdp' AND mail='$mail'";
                $ex = mysqli_query($base, $query);
                if ($ex) {
                    $row = mysqli_fetch_assoc($ex);
                    return $row["idmembre"];
                }
            } else {
                return false;
            }
        } else {
            return -1;
        }
    }
}


?>
