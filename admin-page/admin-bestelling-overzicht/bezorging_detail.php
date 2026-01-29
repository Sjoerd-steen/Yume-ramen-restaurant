<?php
session_start();
require("../../config.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../../inlog/inlog.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig order ID");
}

$orderID = (int) $_GET['id'];

$sql = "
SELECT 
    OrderID,
    OrderDatum,
    TotalAantal,
    Bestelling,
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
<link rel="stylesheet" href="../../Header.css">
<link rel="stylesheet" href="style.css">

<header>
    <div class="logo">
        <a href="../../Ramen.php"><img src="../../image/Logo.png" alt="Logo"></a>
    </div>
    <nav class="nav-buttons">
        <a href="../../Ramen.php" class="header-btn">Home</a>
        <a href="../../klant_recept/recept.php" class="header-btn">Recepten</a>
        <a href="../../bestelling-winkelmandje/winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
        <a href="admin_bestelling_overzicht_view.php" class="header-btn">Bestellingen</a>
        <a href="../admin-menu-item/recept.php" class="header-btn">Menu beheer</a>
        <a href="../../inlog/uitloggen.php" class="header-btn">Uitloggen (<?= htmlspecialchars($_SESSION['naam'] ?? '') ?>)</a>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Order details</h1>

<div class="order-details-box">
    <p><strong>Order ID:</strong> <?= htmlspecialchars($order["OrderID"]) ?></p>
    <p><strong>Orderdatum:</strong> <?= htmlspecialchars($order["OrderDatum"]) ?></p>
    <p><strong>Totaal aantal:</strong> <?= htmlspecialchars($order["TotalAantal"]) ?></p>
    <p><strong>De bestelling:</strong> <?= htmlspecialchars($order["TotalAantal"]) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($order["Bestelling"]) ?></p>
    <p><strong>Bezorgmethode:</strong> <?= htmlspecialchars($order["BezorgMethode"]) ?></p>

    <div class="order-actions">
        <a href="admin_bestelling_overzicht_view.php">← Terug naar overzicht</a>
        <a href="order_edit.php?id=<?= $order["OrderID"] ?>">Edit</a>
    </div>
</div>

<script>
    // Hamburger menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');

    hamburger.addEventListener('click', () => {
        navButtons.classList.toggle('active');
    });
</script>
