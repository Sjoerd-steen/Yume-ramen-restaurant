<?php

require '../../config.php';
try {

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

    if (stmt->rowCount()) {

        $resultaat = "{$naam} is toegevoegd";
    } else {
        $resultaat = "er is iets mis gegaan bij het teoveogen van het item";
    }

} catch (PDOException $e) {

    $resultaat = "Fout is niet correct verstuurd";
}

include __DIR__ . 'admin_menuitem_toevoegen_view.php';
