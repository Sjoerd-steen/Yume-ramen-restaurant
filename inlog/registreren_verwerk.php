<?php
session_start();
require '../config.php';

$naam = trim($_POST['naam'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';
$telefoon = trim($_POST['telefoon'] ?? '');
$addres = trim($_POST['addres'] ?? '');

if ($naam === '' || $email === '' || $password === '' || $password2 === '') {
    header('Location: registreren.php?error=leeg');
    exit;
}

if (strlen($password) < 6 || $password !== $password2) {
    header('Location: registreren.php?error=wachtwoord');
    exit;
}

// Controleren of e-mail al bestaat
$stmt = $conn->prepare("SELECT KlantID FROM Inloggen WHERE Email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    header('Location: registreren.php?error=email_bestaat');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO Inloggen (Naam, Email, Password, TelefoonNummer, Addres, Rol) VALUES (?, ?, ?, ?, ?, 'gebruiker')");
$stmt->execute([$naam, $email, $hash, $telefoon ?: null, $addres ?: null]);

header('Location: inlog.php?registreer=ok');
exit;
