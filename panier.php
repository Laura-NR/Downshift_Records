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

    <main class="container" style="min-height: 70vh;">
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
                            <td id="img_title"><img src="images/<?= $item['vignette'] ?>" alt="<?= htmlspecialchars($item['titre']) ?>"><?= htmlspecialchars($item['titre']) ?></td>
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
        </table>
        <div id="total_payer">
            <h3>Total à payer: <?= number_format($total, 2) ?> €</h3>

            <form action="confirmation.php" method="post">
                <input type="hidden" name="total" value="<?= number_format($total, 2) ?>">
                <input type="submit" value="Confirmer le payment">
            </form>
        </div>
        <div class="return_container">
            <a href="index.php" class="return_btn">Continuer à acheter</a>
        </div>
    </main>

    <footer>
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>