<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


if (!empty($_POST['carte_bleu']) && !empty($_POST['validite']) && !empty($_POST['code'])) {

    $carte = $_POST['carte_bleu'];
    $date = $_POST['validite'];
    $code = $_POST['code'];

    $today = new DateTime();
    $valide = (clone $today)->modify('+3 months');

    $date_input = new DateTime($date);

    $first_nb = $carte[0];
    $last_nb = $carte[strlen($carte) - 1];

    if ($first_nb !== $last_nb) {
        echo "Votre carte bleu n'est pas valide";
    }

    if ($date_input <= $valide) {
        echo "Votre carte bleu doit être valide pendant au moins 3 mois.";
    } 

    unset($_SESSION['cart']);
    echo "Merci pour votre achat";
    echo "<a href='index.php' id='retour_accueil'>Retour à l'accueil</a>";
} else {
    echo "Toutes les champs sont obligatoires";
}
