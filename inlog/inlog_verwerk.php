<?php
session_start();
require '../config.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header('Location: inlog.php?error=leeg&e=' . urlencode($email));
    exit;
}

$stmt = $conn->prepare("SELECT KlantID, Naam, Email, Password, Rol FROM Inloggen WHERE Email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['Password'])) {
    header('Location: inlog.php?error=geen_match&e=' . urlencode($email));
    exit;
}

$_SESSION['klant_id'] = (int) $user['KlantID'];
$_SESSION['naam'] = $user['Naam'];
$_SESSION['email'] = $user['Email'];
$_SESSION['rol'] = $user['Rol'];

header('Location: ../Ramen.php');
exit;
