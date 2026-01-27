<?php
session_start();
require '../config.php';

// Merge cart from $_SESSION['cart'] and $_SESSION['toegevoegd']
$cart = $_SESSION['cart'] ?? [];
$toegevoegd = $_SESSION['toegevoegd'] ?? [];

if (!empty($toegevoegd)) {
    $ids = implode(',', array_map('intval', $toegevoegd));
    $stmt = $conn->prepare("SELECT * FROM MenuItem WHERE ID IN ($ids)");
    $stmt->execute();
    $addedItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($addedItems as $item) {
        $cart[] = [
            'naam' => $item['Naam'],
            'prijs' => $item['Price'],
            'aantal' => 1
        ];
    }
}

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bezorgmethode'])) {
    $bezorgmethode = $_POST['bezorgmethode'];
    $bestellingNamen = implode(', ', array_map(fn($i) => $i['naam'], $cart));
    $totaalAantal = array_sum(array_column($cart, 'aantal'));

    $stmt = $conn->prepare("INSERT INTO GeplaatseOrder (OrderDatum, Bestelling, TotalAantal, Status, BezorgMethode) 
                            VALUES (:datum, :bestelling, :totaal, 'Pending', :bezorg)");
    $stmt->execute([
        ':datum' => date('Y-m-d'),
        ':bestelling' => $bestellingNamen,
        ':totaal' => $totaalAantal,
        ':bezorg' => $bezorgmethode
    ]);

    unset($_SESSION['cart'], $_SESSION['toegevoegd']);
    header("Location: order_bevestiging.php");
    exit;
}

// Calculate totals
$totaalAantal = array_sum(array_column($cart, 'aantal'));
$totaalPrijs = 0;
foreach ($cart as $item) {
    $totaalPrijs += $item['prijs'] * $item['aantal'];
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="image/Logo.png" alt="Logo">
    </div>
    <nav class="nav-buttons">
        <a href="../../index.html" class="header-btn">Home</a>
        <a href="../klant_recept/recept.php" class="header-btn">Recepten</a>
        <a href="winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Winkelmandje</h1>

<?php if (count($cart) > 0): ?>
    <form method="post">
        <div class="orders-container">
            <?php foreach ($cart as $index => $item):
                $subtotaal = $item['prijs'] * $item['aantal'];
                ?>
                <div class="order-card">
                    <p><strong>Product:</strong> <?= htmlspecialchars($item['naam']) ?></p>
                    <p><strong>Prijs:</strong> €<span class="prijs-per-item"><?= number_format($item['prijs'], 2, ',', '.') ?></span></p>
                    <p>
                        <strong>Aantal:</strong>
                        <input type="number" class="qty-input" data-index="<?= $index ?>" data-price="<?= $item['prijs'] ?>" value="<?= $item['aantal'] ?>" min="1">
                    </p>
                    <p><strong>Subtotaal:</strong> €<span class="subtotal"><?= number_format($subtotaal, 2, ',', '.') ?></span></p>
                </div>
            <?php endforeach; ?>

            <div class="order-card">
                <h2>Totaal aantal: <span id="total-amount"><?= $totaalAantal ?></span></h2>
                <h2>Totaal prijs: €<span id="total-price"><?= number_format($totaalPrijs, 2, ',', '.') ?></span></h2>

                <p>
                    <label for="bezorgmethode"><strong>Bezorgmethode:</strong></label>
                    <select name="bezorgmethode" id="bezorgmethode" required>
                        <option value="">Selecteer methode</option>
                        <option value="Afhalen">Afhalen</option>
                        <option value="Bezorgen">Bezorgen</option>
                    </select>
                </p>

                <div class="order-actions">
                    <button type="submit" id="place-order-btn">Bestelling plaatsen</button>
                </div>
            </div>
        </div>
    </form>
<?php else: ?>
    <p style="text-align:center;">Je winkelmandje is leeg.</p>
    <div class="button-container">
        <a href="../klant_recept/recept.php" class="recepten-btn">Recepten</a>
    </div>

<?php endif; ?>

<script>
    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalAmountEl = document.getElementById('total-amount');
    const totalPriceEl = document.getElementById('total-price');

    function formatPrice(value) {
        return value.toFixed(2).replace('.', ',');
    }

    qtyInputs.forEach(input => {
        input.addEventListener('input', () => {
            let totalAmount = 0;
            let totalPrice = 0;

            qtyInputs.forEach(i => {
                const qty = parseInt(i.value);
                const price = parseFloat(i.dataset.price);
                const subtotal = qty * price;
                i.closest('.order-card').querySelector('.subtotal').textContent = formatPrice(subtotal);
                totalAmount += qty;
                totalPrice += subtotal;
            });

            totalAmountEl.textContent = totalAmount;
            totalPriceEl.textContent = formatPrice(totalPrice);
        });
    });

    // Hamburger menu
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    hamburger.addEventListener('click', () => {
        navButtons.classList.toggle('active');
    });

    // Clear localStorage when placing the order
    document.getElementById('place-order-btn').addEventListener('click', function() {
        // Remove specific cart key if you use one
        localStorage.removeItem('cart'); // or whatever key you store cart under

        // Or clear all localStorage (optional)
        // localStorage.clear();
    });
</script>

</body>
</html>
