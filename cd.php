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

    $sql = "SELECT Cd.id, Cd.titre AS titre, chansons.titre AS song_title, chansons.duree, Cd.prix, Cd.vignette_large, 
        Cd.idAuteur, auteurs.nom AS auteur_nom 
        FROM " . PREFIX . "Cd AS Cd 
        LEFT JOIN " . PREFIX . "Chansons AS chansons ON Cd.id = chansons.id_CD 
        LEFT JOIN " . PREFIX . "Auteur AS auteurs ON Cd.idAuteur = auteurs.id 
        WHERE Cd.id = :id_cd 
        ORDER BY Cd.id";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute([':id_cd' => $cd_id]);

    $cdAndSongs = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

    if (!$cdAndSongs) {
        echo "CD not found.";
        exit;
    }

    $cd = $cdAndSongs[0];
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
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <title>Document</title>
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
        <h1 class="page_title">Détails du CD:</h1>

        <div class="cd-details">
            <div class="cd">
                <img src="<?= "images/" . $cd['vignette_large'] ?>" alt="<?= htmlspecialchars($cd['titre']) ?>">
                <div class="details">
                    <div class="cd_info">
                        <p><strong>Nom:</strong> <?= htmlspecialchars($cd['titre']) ?></p>
                        <p><strong>Artiste:</strong> <?= htmlspecialchars($cd['auteur_nom']) ?></p>
                        <h5>Prix : <?= $cd['prix'] ?>€</h5>
                    </div>
                    <form action="add_cart.php" method="post">
                        <input type="hidden" name="id_cd" value="<?= $cd['id'] ?>">
                        <input type="submit" class="ajout_btn" value="Ajouter au panier">
                    </form>
                </div>
            </div>
            <div class="songs">
                <h2>Chansons :</h2>
                <?php if (!empty($cdAndSongs[0]['song_title'])): ?>
                    <ul>
                        <?php foreach ($cdAndSongs as $song): ?>
                            <li><?= htmlspecialchars($song['song_title']) ?> - <?= htmlspecialchars($song['duree']) ?> min</li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucune chanson n'est associée à ce CD.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="return_container">
            <a href="index.php" class="return_btn">Retour aux CDs</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>