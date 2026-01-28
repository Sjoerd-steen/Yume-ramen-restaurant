<?php
session_start();
require 'config.php';

$ingelogd = isset($_SESSION['klant_id']);
$is_admin = $ingelogd && ($_SESSION['rol'] ?? '') === 'admin';
$is_gebruiker = $ingelogd && ($_SESSION['rol'] ?? '') === 'gebruiker';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yume Ramen - Home</title>
    <link rel="stylesheet" href="Header.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="Ramen.php"><img src="image/Logo.png" alt="Logo"></a>
    </div>
    <nav class="nav-buttons">
        <a href="Ramen.php" class="header-btn">Home</a>
        <?php if ($is_gebruiker || $is_admin): ?>
            <a href="klant_recept/recept.php" class="header-btn">Recepten</a>
            <a href="bestelling-winkelmandje/winkelmandje_verwerk_view.php" class="header-btn">Winkelmandje</a>
        <?php endif; ?>
        <?php if ($is_admin): ?>
            <a href="admin-page/admin-bestelling-overzicht/admin_bestelling_overzicht_view.php" class="header-btn">Bestellingen</a>
            <a href="admin-page/admin-menu-item/recept.php" class="header-btn">Menu beheer</a>
        <?php endif; ?>
        <?php if ($ingelogd): ?>
            <a href="inlog/uitloggen.php" class="header-btn">Uitloggen (<?= htmlspecialchars($_SESSION['naam']) ?>)</a>
        <?php else: ?>
            <a href="inlog/inlog.php" class="header-btn">Inloggen</a>
            <a href="inlog/registreren.php" class="header-btn">Registreren</a>
        <?php endif; ?>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Welkom bij Yume Ramen</h1>

<div class="home-welcome">
    <?php if ($ingelogd): ?>
        <p>Hallo <strong><?= htmlspecialchars($_SESSION['naam']) ?></strong>, welkom terug.</p>
    <?php else: ?>
        <p>Geniet van heerlijke ramen. Log in of maak een account om te bestellen.</p>
    <?php endif; ?>
</div>

<div class="home-links">
    <?php if ($is_gebruiker || $is_admin): ?>
        <a href="klant_recept/recept.php" class="home-klant">Recepten bekijken</a>
        <a href="bestelling-winkelmandje/winkelmandje_verwerk_view.php" class="home-klant">Winkelmandje</a>
    <?php endif; ?>
    <?php if ($is_admin): ?>
        <a href="admin-page/admin-bestelling-overzicht/admin_bestelling_overzicht_view.php" class="home-admin">Bestellingen beheren</a>
        <a href="admin-page/admin-menu-item/recept.php" class="home-admin">Menu beheren</a>
    <?php endif; ?>
    <?php if (!$ingelogd): ?>
        <a href="inlog/inlog.php">Inloggen</a>
        <a href="inlog/registreren.php">Registreren</a>
    <?php endif; ?>
</div>

<script>
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    if (hamburger) hamburger.addEventListener('click', () => navButtons.classList.toggle('active'));
</script>
</body>
</html>
