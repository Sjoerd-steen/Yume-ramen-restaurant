<?php
session_start();

// Voorbeeld winkelmandje (normaal komt dit uit session/database)
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        ["naam" => "Pizza Margherita", "prijs" => 8.50, "aantal" => 2],
        ["naam" => "Pasta Carbonara", "prijs" => 10.00, "aantal" => 1]
    ];
}

$cart = $_SESSION['cart'];
$totaal = 0;
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="image/Logo.png" alt="Logo">
    </div>

    <nav class="nav-buttons">
        <a href="../../index.html" class="header-btn">Home</a>
        <a href="../recepten.html" class="header-btn">Recepten</a>
        <a href="winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
    </nav>

    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Dit is alleen nog voorbeeld van de css  </h1>

<?php if (count($cart) > 0): ?>
    <div class="orders-container">
        <?php foreach ($cart as $item):
            $subtotaal = $item['prijs'] * $item['aantal'];
            $totaal += $subtotaal;
            ?>
            <div class="order-card">
                <p><strong>Product:</strong> <?= htmlspecialchars($item['naam']) ?></p>
                <p><strong>Prijs:</strong> €<?= number_format($item['prijs'], 2, ',', '.') ?></p>
                <p><strong>Aantal:</strong> <?= $item['aantal'] ?></p>
                <p><strong>Subtotaal:</strong> €<?= number_format($subtotaal, 2, ',', '.') ?></p>

                <div class="order-actions">
                    <a href="#">Aantal wijzigen</a>
                    <a href="#" onclick="return confirm('Product verwijderen?')">Verwijderen</a>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="order-card">
            <h2>Totaal: €<?= number_format($totaal, 2, ',', '.') ?></h2>
            <div class="order-actions">
                <a href="#">Verder winkelen</a>
                <a href="#">Afrekenen</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <p style="text-align:center;">Je winkelmandje is leeg.</p>
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