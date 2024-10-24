<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['id_cd'], $_POST['quantite'])) {
    $cd_id = $_POST['id_cd'];
    $new_quantity = (int)$_POST['quantite'];

    if ($new_quantity > 0 && isset($_SESSION['cart'][$cd_id])) {
        $_SESSION['cart'][$cd_id]['quantite'] = $new_quantity;
    }

    header('Location: panier.php'); 
    exit;
}
?>
