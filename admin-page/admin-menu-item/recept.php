<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'config.php';


try{
    $query = "SELECT * FROM MenuItem";
    $stmt = $conn->prepare($query);
    $stmt -> execute();


    $resultaten = $stmt -> fetchAll();
    $aantalRijen = count($resultaten);

    include_once 'view/recept_view.php';
} catch (PDOException $e) {
    echo '<p>fout</p>';
    echo '<P>query' . $query . ' </P>.';
    echo '<P>foutmelding' . $e->getMessage() . '</P>';
    exit;
}
