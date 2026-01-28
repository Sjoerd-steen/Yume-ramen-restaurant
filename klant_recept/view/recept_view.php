<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepten - Yume Ramen</title>
    <link rel="stylesheet" href="../Header.css">
    <link rel="stylesheet" href="../bestelling-winkelmandje/style.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="../Ramen.php"><img src="../image/Logo.png" alt="Logo"></a>
    </div>
    <nav class="nav-buttons">
        <a href="../Ramen.php" class="header-btn">Home</a>
        <a href="../recept.php" class="header-btn">Recepten</a>
        <a href="../bestelling-winkelmandje/winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
        <?php if (isset($_SESSION['klant_id'])): ?>
            <a href="../inlog/uitloggen.php" class="header-btn">Uitloggen (<?= htmlspecialchars($_SESSION['naam'] ?? '') ?>)</a>
        <?php else: ?>
            <a href="../inlog/inlog.php" class="header-btn">Inloggen</a>
            <a href="../inlog/registreren.php" class="header-btn">Registreren</a>
        <?php endif; ?>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Recepten - Klant</h1>

<?php
if ($aantalRijen > 0) { ?>
    <ul>
        <?php foreach ($resultaten as $rij) { ?>
            <li>
                <p><strong>Naam:</strong> <?= htmlspecialchars($rij["Naam"]) ?></p>
                <p><strong>Beschrijving:</strong> <?= htmlspecialchars($rij["Beschrijving"]) ?></p>
                <p><strong>Categorie:</strong> <?= htmlspecialchars($rij["Category"]) ?></p>
                <img src="<?= htmlspecialchars($rij["ImageURL"]) ?>">
                <p><strong>Prijs:</strong> <?= htmlspecialchars($rij["Price"]) ?></p>

                <strong>Acties</strong>
                <a href="recept.php?ID<?=$rij['ID']?>">overzicht</a>
                <a href="recept_detail.php?ID=<?=$rij['ID']?>">Details</a>
                <form method="post" action="toevoegen.php">
                    <input type="hidden" name="ID" value="<?= $rij['ID'] ?>">
                    <button type="submit">Toevoegen</button>
                </form>
            </li>
            <hr>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>Geen resultaten gevonden</p>
<?php } ?>

<script>
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    if (hamburger) hamburger.addEventListener('click', () => navButtons.classList.toggle('active'));
</script>
</body>
</html>