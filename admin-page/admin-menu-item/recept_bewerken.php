<?php
require '../../config.php';


//lees het ID uit de URL
$ID = $_GET['ID'];
//toon het id op het scherm
echo "ID van het agenda-item is:" . $ID . "
";

try {
    $query = "SELECT * FROM MenuItem where ID = :ID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();

//haal alle resultaten op in een array
    $resultaten = $stmt->fetchAll();

//aantl resultaten tellen
    $aantalRijen = count($resultaten);


    include 'view/recept_view.php';
    include 'view/recept_bewerken_view.php';

} catch (PDOException $e) {
    // foutafhandeling als de quert niet wordt uitgevoerd
    echo "<p>Fout!</p>";
    echo "<p>Query: " . $query . "</p>";
    echo "<p>Foutmelding: " . $e->getMessage() . "</p>";
    exit;
};
