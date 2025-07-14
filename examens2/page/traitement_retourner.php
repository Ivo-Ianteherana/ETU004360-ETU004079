<?php
require('../inc/function.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['retourner'])) {
    $id_emprunt = $_POST['retourner'];
    $membre_id = $_POST['membre_id'];
    $etat = isset($_POST['etat'][$id_emprunt]) ? $_POST['etat'][$id_emprunt] : '';

    if (empty($etat)) {
        header("Location: fiche_membre.php?m_no=$membre_id&error=no_state");
        exit();
    }

    $success = return_object($id_emprunt, $etat);

    if ($success) {
        header("Location: fiche_membre.php?m_no=$membre_id&success=$etat");
    } else {
        header("Location: fiche_membre.php?m_no=$membre_id&error=echec");
    }
} else {
    header("Location: home.php");
}

exit();
?>