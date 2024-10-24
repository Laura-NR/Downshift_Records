<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['id_cd'])) {
    $cd_id = $_POST['id_cd'];
    unset($_SESSION['cart'][$cd_id]); 

    header('Location: panier.php'); 
    exit;
}
?>