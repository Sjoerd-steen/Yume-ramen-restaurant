<?php
session_start();

// Als al ingelogd, doorverwijzen naar homepage
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
    <title>Inloggen - Yume Ramen</title>
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

<h1>Inloggen</h1>

<div class="login-box">
    <?php if (isset($_GET['registreer']) && $_GET['registreer'] === 'ok'): ?>
        <div class="success-msg">Account aangemaakt. Je kunt nu inloggen.</div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="error-msg">
            <?php
            switch ($_GET['error']) {
                case 'leeg': echo 'Vul e-mail en wachtwoord in.'; break;
                case 'geen_match': echo 'Ongeldige e-mail of wachtwoord.'; break;
                default: echo 'Er is een fout opgetreden.';
            }
            ?>
        </div>
    <?php endif; ?>

    <form method="post" action="inlog_verwerk.php">
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="voorbeeld@email.nl" required
                   value="<?= htmlspecialchars($_GET['e'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="inlog-actions">
            <button type="submit">Inloggen</button>
        </div>
    </form>
    <div class="registreer-link">
        Nog geen account? <a href="registreren.php">Registreren</a>
    </div>
</div>

<script>
    const hamburger = document.querySelector('.hamburger');
    const navButtons = document.querySelector('.nav-buttons');
    if (hamburger) hamburger.addEventListener('click', () => navButtons.classList.toggle('active'));
</script>
</body>
</html>
