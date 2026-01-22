<?php
require("../../config.php");
session_start();

$sql = "
SELECT 
    OrderID,
    OrderDatum,
    TotalAantal,
    Status,
    BezorgMethode
FROM GeplaatseOrder
ORDER BY OrderID DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../../Header.css">

<header>
    <!-- Logo links -->
    <div class="logo">
        <img src="../../image/Logo.png" alt="Logo" height="50">
    </div>

    <!-- Knoppen rechts -->
    <nav class="nav-buttons">
        <a href="recepten.html" class="header-btn">Recepten</a>
        <a href="index.html" class="header-btn">Home</a>
        <a href="bestel.html" class="header-btn">Bestel</a>
    </nav>
</header>
<h1>Geplaatste orders</h1>

<?php if (count($resultaten) > 0): ?>

    <?php foreach ($resultaten as $rij): ?>
        <div>
            <hr>

            <p><strong>Order ID:</strong>
                <?= htmlspecialchars($rij["OrderID"]) ?>
            </p>

            <p><strong>Orderdatum:</strong>
                <?= htmlspecialchars($rij["OrderDatum"]) ?>
            </p>

            <p><strong>Totaal aantal:</strong>
                <?= htmlspecialchars($rij["TotalAantal"]) ?>
            </p>

            <p><strong>Status:</strong>
                <?= htmlspecialchars($rij["Status"]) ?>
            </p>

            <p><strong>Bezorgmethode:</strong>
                <?= htmlspecialchars($rij["BezorgMethode"]) ?>
            </p>

            <p>
                <a href="bezorging_detail.php?id=<?= $rij["OrderID"] ?>">
                    Details
                </a>
                <a href="order_edit.php?id=<?= $rij["OrderID"] ?>">Edit</a>
                <a href="order_verwijderen.php?id=<?= $rij["OrderID"] ?>"
                   onclick="return confirm('Weet je zeker dat je deze order wilt verwijderen?');">
                    Verwijderen
                </a>


            <hr>
        </div>
    <?php endforeach; ?>

<?php else: ?>
    <p>Geen orders gevonden.</p>
<?php endif; ?>
