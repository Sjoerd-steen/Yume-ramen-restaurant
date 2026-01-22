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

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geplaatste Orders</title>
    <link rel="stylesheet" href="../../Header.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="../../image/Logo.png" alt="Logo">
    </div>

    <nav class="nav-buttons">
        <a href="recepten.html" class="header-btn">Recepten</a>
        <a href="index.html" class="header-btn">Home</a>
        <a href="bestel.html" class="header-btn">Bestel</a>
    </nav>

    <!-- Hamburger menu -->
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>



<h1>Geplaatste orders</h1>

<?php if (count($resultaten) > 0): ?>
    <div class="orders-container">
        <?php foreach ($resultaten as $rij): ?>
            <div class="order-card">
                <p><strong>Order ID:</strong> <?= htmlspecialchars($rij["OrderID"]) ?></p>
                <p><strong>Orderdatum:</strong> <?= htmlspecialchars($rij["OrderDatum"]) ?></p>
                <p><strong>Totaal aantal:</strong> <?= htmlspecialchars($rij["TotalAantal"]) ?></p>
                <p><strong>Status:</strong> <?= htmlspecialchars($rij["Status"]) ?></p>
                <p><strong>Bezorgmethode:</strong> <?= htmlspecialchars($rij["BezorgMethode"]) ?></p>

                <div class="order-actions">
                    <a href="bezorging_detail.php?id=<?= $rij["OrderID"] ?>">Details</a>
                    <a href="order_edit.php?id=<?= $rij["OrderID"] ?>">Edit</a>
                    <a href="order_verwijderen.php?id=<?= $rij["OrderID"] ?>" onclick="return confirm('Weet je zeker dat je deze order wilt verwijderen?');">Verwijderen</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p style="text-align:center; color:white;">Geen orders gevonden.</p>
<?php endif; ?>

<script>

        const hamburger = document.querySelector('.hamburger');
        const navButtons = document.querySelector('.nav-buttons');

        hamburger.addEventListener('click', () => {
        navButtons.classList.toggle('active');
    });

</script>
</body>
</html>
