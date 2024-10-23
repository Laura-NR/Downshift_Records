<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
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
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title>{{ constant('${WEBSITE_TITLE}') }}</title>
</head>

<body class="container">



    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">{{ constant('${WEBSITE_TITLE}') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">CDs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recettes.php">Chansons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recettes_tableau.php">Artistes/Groupes</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <h1 class="mycolor">Les CDs</h1>

        <div id="zone_cartes" class="row row-cols-3">

            <?php foreach ($cds as $cd) { ?>
                <a href="cd.php?id_cd=<?= $cd['id'] ?>" class="col mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= "images/" . $cd['vignette'] ?>" class="card-img-top" alt="<?= $cd['titre'] ?>">
                        <div class="card-body bg-primary">
                            <h5><?= $cd['titre'] ?></h5>
                        </div>
                    </div>
                </a>
            <?php } ?>

        </div>
    </main>
    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>

</body>

</html>