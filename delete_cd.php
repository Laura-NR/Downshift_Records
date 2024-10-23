<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id']) || $_SESSION['username'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if (isset($_POST['id_cd']) && is_numeric($_POST['id_cd'])) {
    $cd_id = $_POST['id_cd'];

    $sql = "DELETE FROM " . PREFIX . "Cd WHERE id = :id";
    $pdoStatement = $pdo->prepare($sql);

    if ($pdoStatement->execute(['id' => $cd_id])) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Erreur lors de la suppression du CD.";
    }
} else {
    header('Location: admin.php');
    exit;
}
