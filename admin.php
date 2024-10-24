<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['username'] !== 'admin') {
    echo "Vous n'avez pas le droit d'accès à cette page";
    exit;
}

$sql = "SELECT * FROM " . PREFIX . "Cd";
$pdoStatement = $pdo->prepare($sql);
$pdoStatement->execute();
$cds = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <title>Admin dashboard - <?= constant('WEBSITE_TITLE') ?></title>
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
        <h1 class="mycolor">Les CDs</h1>
        <div id="ajout_container">
            <a href="add_form.php" class="ajout_btn" id="ajout_cd">Ajouter un CD</a>
        </div>
        <div class="zone_cds">

            <?php foreach ($cds as $cd) { ?>
                <div class="div_cd">
                    <a href="cd.php?id_cd=<?= $cd['id'] ?>" class="col mb-3">
                        <img src="<?= "images/" . $cd['vignette'] ?>" class="card-img-top" alt="<?= $cd['titre'] ?>">
                    </a>
                    <div class="info">
                        <h1><?= $cd['titre'] ?></h1>
                    </div>
                    <form action="delete_cd.php" method="post">
                        <input type="hidden" name="id_cd" value="<?= $cd['id'] ?>">
                        <input type="submit" value="Supprimer CD">
                    </form>
                </div>
            <?php } ?>

        </div>
    </main>
    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>