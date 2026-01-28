<?php
session_start();

if (isset($_SESSION['klant_id'])) {
    header('Location: ../Ramen.php');
    exit;
}

require '../config.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - Yume Ramen</title>
    <link rel="stylesheet" href="../Header.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="../Ramen.php"><img src="../image/Logo.png" alt="Logo"></a>
    </div>
    <nav class="nav-buttons">
        <a href="../Ramen.php" class="header-btn">Home</a>
        <a href="inlog.php" class="header-btn">Inloggen</a>
        <a href="registreren.php" class="header-btn">Registreren</a>
    </nav>
    <div class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</header>

<h1>Account aanmaken</h1>

<div class="registreer-box">
    <?php if (isset($_GET['error'])): ?>
        <div class="error-msg">
            <?php
            switch ($_GET['error']) {
                case 'leeg': echo 'Vul alle verplichte velden in.'; break;
                case 'email_bestaat': echo 'Dit e-mailadres is al in gebruik.'; break;
                case 'wachtwoord': echo 'Wachtwoorden komen niet overeen of zijn te kort (min. 6 tekens).'; break;
                default: echo 'Er is een fout opgetreden.';
            }
            ?>
        </div>
    <?php endif; ?>

    <form method="post" action="registreren_verwerk.php">
        <div class="form-group">
            <label for="naam">Naam *</label>
            <input type="text" id="naam" name="naam" required placeholder="Je volledige naam">
        </div>
        <div class="form-group">
            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" required placeholder="voorbeeld@email.nl">
        </div>
        <div class="form-group">
            <label for="password">Wachtwoord *</label>
            <input type="password" id="password" name="password" required placeholder="Minimaal 6 tekens" minlength="6">
        </div>
        <div class="form-group">
            <label for="password2">Wachtwoord herhalen *</label>
            <input type="password" id="password2" name="password2" required placeholder="Herhaal wachtwoord">
        </div>
        <div class="form-group">
            <label for="telefoon">Telefoonnummer</label>
            <input type="tel" id="telefoon" name="telefoon" placeholder="06 12345678">
        </div>
        <div class="form-group">
            <label for="addres">Adres</label>
            <input type="text" id="addres" name="addres" placeholder="Straat, huisnummer, postcode, plaats">
        </div>
        <div class="registreer-actions">
            <button type="submit">Account aanmaken</button>
        </div>
    </form>
    <div class="login-link">
        Heb je al een account? <a href="inlog.php">Inloggen</a>
    </div>
</div>

<script>
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    if (hamburger) hamburger.addEventListener('click', () => navButtons.classList.toggle('active'));
</script>
</body>
</html>
