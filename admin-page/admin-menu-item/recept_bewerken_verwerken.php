<?php
session_start();
require '../../config.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../inlog/inlog.php');
    exit;
}

try {
    $resultaat = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $ID = $_POST['ID'];
        $Naam = $_POST['Naam'];
        $Beschrijving = $_POST['Beschrijving'];
        $Category = $_POST['Category'];
        $ImageURL = $_POST['ImageURL'];
        $Price = $_POST['Price'];

        $query = "UPDATE MenuItem
                  SET Naam = :Naam, Beschrijving = :Beschrijving, Category = :Category, ImageURL = :ImageURL,
                      Price = :Price
                  WHERE ID = :ID";

        $stmt = $conn->prepare($query);

        $stmt->execute([
            ':Naam' => $Naam,
            ':Beschrijving' => $Beschrijving,
            ':Category' => $Category,
            ':ImageURL' => $ImageURL,
            ':Price' => $Price,
            ':ID' => $ID
        ]);

        if ($stmt->rowCount()) {
            $resultaat = "{$Naam} is aangepast.";
        } else {
            $resultaat = "Er is iets fout gegaan.";
        }

    } // einde if ($_SERVER['REQUEST_METHOD'] == 'POST')

} catch (PDOException $e) {
    $resultaat = "Fout bij het toevoegen: " . $e->getMessage();
}
include 'view/recept_bewerken_verwerken_view.php';