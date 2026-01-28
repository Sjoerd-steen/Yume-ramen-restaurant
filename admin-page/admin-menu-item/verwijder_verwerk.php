<?php
session_start();
require '../../config.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../inlog/inlog.php');
    exit;
}

$ID = $_GET['ID'] ?? null;
try {
    $query = 'DELETE FROM MenuItem WHERE  ID = :ID';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();

    if ($stmt->rowCount()) {
        $resultaat = "Het is verwijderd";
        echo $resultaat;
    } else {
        $resultaat = "Er zijn geen resultaten gevonden";
        echo $resultaat;
    }
    $stmt = $conn->prepare($query);



} catch (PDOException $e) {
    echo "<p>Fout</p>";
    echo "<p>Query: ".$query."</p>";
    echo "<p>Foutmelding: " . $e->getMessage(). "</p>";
    exit;
}
?>
<br>
<a href="./recept.php">Overzicht</a>