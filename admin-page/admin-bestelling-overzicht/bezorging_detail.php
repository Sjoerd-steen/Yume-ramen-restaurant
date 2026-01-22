<?php
require("../../config.php");
session_start();


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig order ID");
}

$orderID = (int) $_GET['id'];


$sql = "
SELECT 
    OrderID,
    OrderDatum,
    TotalAantal,
    Status,
    BezorgMethode
FROM GeplaatseOrder
WHERE OrderID = :orderID
LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
$stmt->execute();

$order = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$order) {
    die("Order niet gevonden");
}
?>

<h1>Order details</h1>

<div>
    <hr>

    <p><strong>Order ID:</strong>
        <?= htmlspecialchars($order["OrderID"]) ?>
    </p>

    <p><strong>Orderdatum:</strong>
        <?= htmlspecialchars($order["OrderDatum"]) ?>
    </p>

    <p><strong>Totaal aantal:</strong>
        <?= htmlspecialchars($order["TotalAantal"]) ?>
    </p>

    <p><strong>Status:</strong>
        <?= htmlspecialchars($order["Status"]) ?>
    </p>

    <p><strong>Bezorgmethode:</strong>
        <?= htmlspecialchars($order["BezorgMethode"]) ?>
    </p>

    <hr>

    <p>
        <a href="admin_bestelling_overzicht_view.php">
            ← Terug naar overzicht
        </a>
    </p>
    <a href="order_edit.php?id=<?= $rij["OrderID"] ?>">Edit</a>
</div>
