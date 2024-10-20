<?php
session_start();
require_once 'include.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        header('Location: login.php');
        exit;
    }

    $sql = "SELECT * FROM " . PREFIX . "user WHERE email = :email";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute(['email' => $email]);
    $user = $pdoStatement->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        if ($user['username'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: index.php');
        }
    } else {
        echo 'Email ou mot de passe incorrect';
    }

}
