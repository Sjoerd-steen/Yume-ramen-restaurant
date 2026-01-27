<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/agenda_view.css">
</head>
<body>
<h1>Recepten - Admin</h1>

<?php
if ($aantalRijen > 0) { ?>
    <ul>
        <?php foreach ($resultaten as $rij) { ?>
            <li>
                <p><strong>Naam:</strong> <?= htmlspecialchars($rij["Naam"]) ?></p>
                <p><strong>Beschrijving:</strong> <?= htmlspecialchars($rij["Beschrijving"]) ?></p>
                <p><strong>Categorie:</strong> <?= htmlspecialchars($rij["Category"]) ?></p>
                <p><strong>foto:</strong> <?= htmlspecialchars($rij["ImageURL"]) ?></p>
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
</body>
</html>