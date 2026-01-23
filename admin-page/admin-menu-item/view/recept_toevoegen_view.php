<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>toevoegen</title>
</head>
<body>
<form action="./recept_toevoegen_verwerk.php" method="POST">
    <label for="Naam">Naam</label>
    <input type="text" id="Naam" name="Naam" required >
    <br><br>

    <label for="Beschrijving">Beschrijving</label>
    <input type="text" id="Beschrijving" name="Beschrijving" required>
    <br><br>

    <label for="Category">Categorie:</label>
    <select id="Category" name="Category">
        <option value="1">Vegan</option>
        <option value="2">Vlees</option>
        <option value="3">Pittig</option>
    </select>

    <br><br>
    <label for="ImageURL">Foto:</label>
    <input type="text" id="ImageURL" name="ImageURL" required>
    <br><br>

    <label for="Price">Prijs:</label>
    <input type="number" id="Price" name="Price" required>
    <br><br>
    <input type="submit"><br>
    <a href="./recept.php">overzicht</a>
</form>
</body>
</html>