<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['total'])) {
    $total = $_POST['total'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <title><?= constant('WEBSITE_TITLE') ?></title>
</head>

<body>
    <header>
        <nav class="header_menu">
            <a class="navbar-brand" href="index.php"><?= constant('WEBSITE_TITLE') ?></a>
            <div class="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">CDs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="panier.php">Panier</a>
                    </li>
                    <li class="nav-item" id="logout_btn">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container" id="confirm_payment" style="min-height: 70vh;">
        <h1 class="page_title">Confirmation du Payment :</h1>

        <h3 style="margin-bottom: 50px;">Montant total à payer : <?= $total ?></h3>

        <form action="payment.php" method="post">
            <label for="carte_bleu">Numero de carte :</label>
            <input type="tel" id="carte_bleu" name="carte_bleu" placeholder="1234 5678 9245 5876" pattern="[0-9\s]{13,19}" maxlength="16">
            <label for="validite">Numero de carte :</label>
            <input type="date" id="validite" name="validite">
            <label for="code">Code de Securite :</label>
            <input type="number" min="100" max="999" id="code" name="code" pattern="[0-9\s]{13,19}" maxlength="3">
            <input type="submit" value="Confirmer le payment">
        </form>
    </main>
    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>

</body>

</html>