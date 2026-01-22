
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda Item Toevoegen</title>
</head>
<body>

<h1>Nieuw menu item toevoegen</h1>

<form action="menuitem_toevoegen_verwerk.php" method="POST">


    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required>


    <label for="beschrijving">Beschrijving:</label>
    <textarea id="beschrijving" name="beschrijving" required></textarea>


    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="n">Vegetarisch</option>
        <option value="b">Vlees</option>
        <option value="a">Pittig</option>
    </select>


    <label for="imageurl">imageURL:</label>
    <textarea id="imageurl" name="imageurl" required></textarea>


    <label for="price">Price:</label>
    <input type="price" id="price" name="price" required>

    <input type="submit" value="Toevoegen">

    <p><a href="../../Ramen.php">← Terug naar Agenda-overzicht</a></p>

</form>

</body>
</html>
