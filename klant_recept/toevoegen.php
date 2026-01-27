<?php
session_start();

if (isset($_POST['ID'])) {
    $id = $_POST['ID'];

    // opslaan in sessie (bijv. winkelmandje)
    $_SESSION['toegevoegd'][] = $id;

    header("Location: recept.php");
    exit;
}
?>
