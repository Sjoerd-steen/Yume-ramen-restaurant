<?php
session_start();
require '../../config.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../inlog/inlog.php');
    exit;
}

$resultaat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Maak een toevoeg-query met named placeholders
        $query = "INSERT INTO MenuItem (Naam, Beschrijving, Category, ImageURL, Price)
                  VALUES (:Naam, :Beschrijving, :Category, :ImageURL, :Price)";

        // Bereid het statement voor
        $stmt = $conn->prepare($query);

        // Haal data uit POST
        $Naam           = $_POST['Naam'];
        $Beschrijving   = $_POST['Beschrijving'];
        $Category       = $_POST['Category'];
        $ImageURL       = $_POST['ImageURL'] ;
        $Price          = $_POST['Price'] ;

        // Voer de query uit
        $stmt->execute([
            'Naam' => $Naam,
            'Beschrijving' => $Beschrijving,
            'Category' => $Category,
            'ImageURL' => $ImageURL,
            'Price' => $Price,
        ]);

        if (
            empty($_POST['Naam']) ||
            empty($_POST['Beschrijving']) ||
            empty($_POST['Category']) ||
            empty($_POST['ImageURL']) ||
            empty($_POST['Price'])
        ) {
            echo 'Niet alles is ingevuld!';
        } else {
            echo 'Het item is toegevoegd!';
        }


        // Controleer of het is gelukt
        if ($stmt->rowCount() > 0) {
            $resultaat = "{$Naam} is toegevoegd!<br>";
        } else {
            $resultaat = "Er is een fout opgetreden bij het toevoegen.<br>";
        }

    } catch (PDOException $e) {
        $resultaat = "Fout bij het toevoegen: " . $e->getMessage();
    }

} else {
    $resultaat = "Formulier is niet verzonden.";
}
include 'view/recept_toevoegen_view.php';

?>