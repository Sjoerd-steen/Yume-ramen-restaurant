<?php
session_start();

if (isset($_POST['ID'])) {
    $id = $_POST['ID'];

    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item is already in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['ID'] == $id) {
            // Increment quantity if already exists
            $item['aantal'] += 1;
            $found = true;
            break;
        }
    }

    // If item not in cart, fetch from DB and add with quantity 1
    if (!$found) {
        require '../config.php';
        $stmt = $conn->prepare("SELECT * FROM MenuItem WHERE ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['cart'][] = [
                'ID' => $row['ID'],
                'naam' => $row['Naam'],
                'prijs' => $row['Price'],
                'aantal' => 1
            ];
        }
    }

    // Redirect back to recepten page
    header("Location: recept.php");
    exit;
}
