<?php
require("../../config.php");
session_start();



if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig order ID");
}

$orderID = (int) $_GET['id'];


$sql = "DELETE FROM GeplaatseOrder WHERE OrderID = :orderid LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':orderid', $orderID, PDO::PARAM_INT);
$stmt->execute();

/* Redirect terug naar overzicht */
header("Location: admin_bestelling_overzicht_view.php");
exit;
