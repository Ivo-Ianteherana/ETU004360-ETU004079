<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../inc/function.php');
session_start();


if (
    isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['dtn']) &&
    isset($_POST['genre']) && isset($_POST['email']) && isset($_POST['ville']) &&
    isset($_FILES['image']) && $_FILES['image']['error'] === 0
) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];
    $dtn = $_POST['dtn'];
    $genre = $_POST['genre'];
    $mail = $_POST['email'];
    $ville = $_POST['ville'];

    $imageName = basename($_FILES['image']['name']);
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $uploadDir = '../assets/uploads/';
    $uploadPath = $uploadDir . $imageName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($imageTmpPath, $uploadPath))
    {

        $load = inscrire($nom, $mdp, $dtn, $genre, $mail, $ville, $imageName);
        if ($load !== false && $load !== -1) {
            $_SESSION['id'] = $load;
            header('Location: home.php');
        } elseif ($load === -1) {
            header('Location: ../page/connexion.php?deja=1');
        } else {
            header('Location: ../page/inscription.php?error=1');
        }
    } else {
        echo "Erreur.";
    }
} else {
    echo "erreur";
}
?>
