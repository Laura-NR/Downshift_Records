<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$panier = $_SESSION['cart'];
$total = 0;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title><?= constant('WEBSITE_TITLE') ?></title>
</head>

<body class="container">
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
        <h1>Voici votre panier :</h1>
        <table>
            <thead>
                <tr>
                    <th>CD</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($panier)): ?>
                    <tr>
                        <td colspan="4">Votre panier est vide.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($panier as $cd_id => $item): ?>
                        <tr>
                            <td><img src="images/<?= $item['vignette'] ?>" alt="<?= htmlspecialchars($item['titre']) ?>"><?= htmlspecialchars($item['titre']) ?></td>
                            <td><?= number_format(floatval($item['prix']), 2) ?> €</td>
                            <td>
                                <form action="quantity.php" method="post">
                                    <input type="hidden" name="id_cd" value="<?= $cd_id ?>">
                                    <input type="number" name="quantite" value="<?= $item['quantite'] ?>" min="1" style="width: 60px;">
                                    <input type="submit" value="Mettre à jour">
                                </form>
                            </td>
                            <td><?= number_format(floatval($item['prix']) * intval($item['quantite']), 2) ?> €</td>
                            <td>
                                <form action="supprimer_cart.php" method="post">
                                    <input type="hidden" name="id_cd" value="<?= $cd_id ?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                        <?php $total += floatval($item['prix']) * intval($item['quantite']); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

            <h3>Total à payer: <?= number_format($total, 2) ?> €</h3>

            <form action="confirmation.php" method="post">
                <input type="hidden" name="total" value="<?= number_format($total, 2) ?>">
                <input type="submit" value="Confirmer le payment">
            </form>

            <a href="index.php">Continuer à acheter</a>
    </main>
    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>

</body>

</html>