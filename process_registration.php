<?php
session_start();
require_once 'include.php';

// Récupération des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Vérification de la validité des données
    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || $password !== $confirmPassword) {
        // Redirection vers la page de création de compte
        header('Location: create_account.php');
        exit;
    }

    //Vérification des mots de passe
    if ($password !== $confirmPassword) {
        echo 'Les mots de passe ne correspondent pas';
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Préparation de la requête
    $sql = "INSERT INTO " . PREFIX . "user (username, email, password) VALUES (:username, :email, :password)";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute([$username, $email, $hashedPassword]);

    // Redirection vers la page de connexion
    echo "Compte créé avec succès ! Vous pouvez vous connecter<br>";
    echo "<a href='login.php'>Aller à la page de connexion</a>";
}