<?php
require("../../config.php");
session_start();



if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig order ID");
}

$orderID = (int) $_GET['id'];


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $orderDatum     = $_POST["OrderDatum"];
    $totalAantal    = (int) $_POST["TotalAantal"];
    $status         = $_POST["Status"];
    $bezorgMethode  = $_POST["BezorgMethode"];

    $updateSql = "
        UPDATE GeplaatseOrder
        SET 
            OrderDatum = :orderdatum,
            TotalAantal = :totalaantal,
            Status = :status,
            BezorgMethode = :bezorgmethode
        WHERE OrderID = :orderid
    ";

    $stmt = $conn->prepare($updateSql);
    $stmt->execute([
        ':orderdatum'    => $orderDatum,
        ':totalaantal'   => $totalAantal,
        ':status'        => $status,
        ':bezorgmethode' => $bezorgMethode,
        ':orderid'       => $orderID
    ]);


    header("Location: admin_bestelling_overzicht_view.php");
    exit;
}


$sql = "
SELECT 
    OrderID,
    OrderDatum,
    TotalAantal,
    Status,
    BezorgMethode
FROM GeplaatseOrder
WHERE OrderID = :orderid
LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':orderid', $orderID, PDO::PARAM_INT);
$stmt->execute();

$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order niet gevonden");
}
?>

<h1>Order bewerken</h1>

<form method="post">
    <p>
        <strong>Order ID:</strong>
        <?= htmlspecialchars($order["OrderID"]) ?>
    </p>

    <p>
        <label>Orderdatum:</label><br>
        <input type="date" name="OrderDatum"
               value="<?= htmlspecialchars($order["OrderDatum"]) ?>" required>
    </p>

    <p>
        <label>Totaal aantal:</label><br>
        <input type="number" name="TotalAantal"
               value="<?= htmlspecialchars($order["TotalAantal"]) ?>" required>
    </p>

    <p>
        <label>Status:</label><br>
        <select name="Status" required>
            <?php
            $statussen = ['Pending', 'Klaarmaken', 'In bezorging'];
            foreach ($statussen as $status) {
                $selected = ($order["Status"] === $status) ? 'selected' : '';
                echo "<option value=\"$status\" $selected>$status</option>";
            }
            ?>
        </select>
    </p>

    <p>
        <label>Bezorgmethode:</label><br>
        <select name="BezorgMethode" required>
            <?php
            $methodes = ['Afhalen', 'Bezorgen'];
            foreach ($methodes as $methode) {
                $selected = ($order["BezorgMethode"] === $methode) ? 'selected' : '';
                echo "<option value=\"$methode\" $selected>$methode</option>";
            }
            ?>
        </select>
    </p>

    <p>
        <button type="submit">Opslaan</button>
        <a href="admin_bestelling_overzicht_view.php">Annuleren</a>
    </p>
</form>
