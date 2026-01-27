<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bewerken</title>
</head>
<body>
<form action="./recept_bewerken_verwerken.php" method="post">
    <input type="hidden" name="ID" value="<?=$rij['ID']?>" required><br>

    <label for="Naam">Naam:</label>
    <input type="text" id="Naam" name="Naam" value="<?=$rij['Naam']?>" required><br>


    <label for="Beschrijving">Beschrijving:</label>
    <input type="text" id="Beschrijving" name="Beschrijving" value="<?=$rij['Beschrijving']?>" required><br>


    <label for="Category">Category:</label>
    <select id="Category" name="Category" required>
        <option value="1" <?= ($rij['Category'] == '1') ? 'selected' : '' ?>>Vegan</option>
        <option value="2" <?= ($rij['Category'] == '2') ? 'selected' : '' ?>>Vlees</option>
        <option value="3" <?= ($rij['Category'] == '3') ? 'selected' : '' ?>>Pittig</option>
    </select><br>

    <label for="ImageURL">Foto:</label>
    <input type="text" id="ImageURL" name="ImageURL" value="<?=$rij['ImageURL']?>" required><br>

    <label for="Price">Prijs:</label>
    <input type="number" id="Price" name="Einddatum" value="<?=$rij['Price']?>" required><br>


    <button type="submit">Aanpassen</button>

</form>
</body>
</html>