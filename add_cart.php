<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['id_cd'])) {
    $cd_id = $_POST['id_cd'];

    $stmt = $pdo->prepare("SELECT * FROM " . PREFIX . "Cd WHERE id = :id");
    $stmt->bindParam(':id', $cd_id);
    $stmt->execute();
    $cd = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cd) {
        # code...
    }
}