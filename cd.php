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

if (isset($_GET['id_cd']) && is_numeric($_GET['id_cd'])) {
    $cd_id = $_GET['id_cd'];

    $sql = "SELECT * FROM " . PREFIX . "Cd WHERE id = :id";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute([':id' => $cd_id]);
    $cd = $pdoStatement->fetch(PDO::FETCH_ASSOC);

    if (!$cd) {
        echo "CD not found.";
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><?= constant('WEBSITE_TITLE') ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">CDs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auteurs.php">Artistes/Groupes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="panier.php">Panier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <h1>Détails du CD: <?= htmlspecialchars($cd['titre']) ?></h1>

        <div class="cd-details">
            <img src="<?= "images/" . $cd['vignette_large'] ?>" alt="<?= htmlspecialchars($cd['titre']) ?>" style="max-width:300px;">
            <p><strong>Nom:</strong> <?= htmlspecialchars($cd['titre']) ?></p>
            <p><strong>Artiste:</strong> <?= htmlspecialchars($cd['idAuteur']) ?></p>
            <h5><?= $cd['prix'] ?></h5>
        </div>

        <form action="add_cart.php" method="post">
            <input type="hidden" name="id_cd" value="<?= $cd['id'] ?>">
            <input type="submit" value="Ajouter au panier">
        </form>

        <a href="index.php" class="btn btn-primary">Retour aux CDs</a>
    </main>

    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>