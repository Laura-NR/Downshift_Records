<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$sql = "SELECT * FROM " . PREFIX . "Cd";
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute();
$cds = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
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

    <main class="container">
        <h1 class="page_title">Voici notre sélection de CD's :</h1>

        <div class="zone_cds">

            <?php foreach ($cds as $cd) { ?>
                <div class="div_cd">
                    <a href="cd.php?id_cd=<?= $cd['id'] ?>">
                        <img src="<?= "images/" . $cd['vignette'] ?>" class="card-img-top" alt="<?= $cd['titre'] ?>">
                    </a>
                    <div class="info">
                        <h1><?= $cd['titre'] ?></h1>
                        <h5>Prix : <?= $cd['prix'] ?>€</h5>
                    </div>
                    <form action="add_cart.php" method="post">
                        <input type="hidden" name="id_cd" value="<?= $cd['id'] ?>">
                        <input type="submit" class="ajout_btn" value="Ajouter au panier">
                    </form>
                </div>
            <?php } ?>

        </div>
    </main>
    <footer>
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>

</body>

</html>