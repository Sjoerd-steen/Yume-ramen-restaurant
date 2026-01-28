<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu beheer - Yume Ramen</title>
    <link rel="stylesheet" href="../../Header.css">
    <link rel="stylesheet" href="recept.css">
    <link rel="stylesheet" href="../../bestelling-winkelmandje/style.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="../../Ramen.php"><img src="../../image/Logo.png" alt="Logo"></a>
    </div>
    <nav class="nav-buttons">
        <a href="../../Ramen.php" class="header-btn">Home</a>
        <a href="../../klant_recept/recept.php" class="header-btn">Recepten</a>
        <a href="../../bestelling-winkelmandje/winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
        <a href="../admin-bestelling-overzicht/admin_bestelling_overzicht_view.php" class="header-btn">Bestellingen</a>
        <a href="recept.php" class="header-btn">Menu beheer</a>
        <a href="../../inlog/uitloggen.php" class="header-btn">Uitloggen (<?= htmlspecialchars($_SESSION['naam'] ?? '') ?>)</a>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Recepten - Admin</h1>

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
                <a href="recept_bewerken.php?ID=<?=$rij['ID']?>">Bewerken</a>
                <a href="verwijder.php?ID=<?=$rij['ID']?>">Verwijder</a>
            </li>
            <hr>
        <?php } ?>
    </ul>
<?php } else { ?>
    <p>Geen resultaten gevonden</p>
<?php } ?>
<a href="recept_toevoegen_verwerk.php" class="knop-toevoegen">toevoegen</a>

<script>
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    if (hamburger) hamburger.addEventListener('click', () => navButtons.classList.toggle('active'));
</script>
</body>
</html>