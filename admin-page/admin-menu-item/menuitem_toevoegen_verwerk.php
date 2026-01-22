<?php
require '../../config.php';

// Controleer of formulier goed is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $naam  = $_POST["naam"];
    $beschrijving    = $_POST["beschrijving"];
    $category = $_POST["category"];
    $imageurl  = $_POST["imageurl"];
    $price = $_POST["price"];


    $query =  "INSERT INTO MenuItem (Naam, Beschrijving, Category, ImageURL, Price)
                VALUES (:naam, :beschrijving, :category, :imageurl, :price)";

    $stmt = $conn->prepare($query);

    $stmt->execute([
        'naam' => $naam,
        'beschrijving' => $beschrijving,
        'category' => $category,
        'imageurl' => $imageurl,
        'price' => $price
    ]);


    try {
        if ($stmt->rowCount() > 0) {
            header("Location: menuitem_toevoegen_verwerk_view.php?naam=" . urlencode($naam));
            exit;
        } else {
            header("Location: menuitem_toevoegen_verwerk_view.php?fout=1");
            exit;
        }
    } catch (PDOException $e) {
        header(
            "Location: agenda_toevoegen_verwerk_view.php?fout=1&melding=" .
            urlencode($e->getMessage())
        );
        exit;
    }
} else {
    header("Location: agenda_toevoegen_verwerk_view.php?fout=1");
    exit;
}

?>


?>
