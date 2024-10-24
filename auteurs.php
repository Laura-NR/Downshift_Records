<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}


if (isset($_GET['id_auteur']) && is_numeric($_GET['id_auteur'])) {
    $auteur_id = $_GET['id_auteur'];

    $sql = "SELECT * FROM " . PREFIX . "Auteur WHERE id = :id";
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->execute([':id' => $auteur_id]);
    $auteur = $pdoStatement->fetch(PDO::FETCH_ASSOC);

    if (!$auteur) {
        echo "Auteur not found.";
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
                            <a class="nav-link" href="songs.php">Chansons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="auteurs.php">CD</a>
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
        <h1>Informations sur l'auteur: <?= htmlspecialchars($auteur['nom']) ?></h1>

        <div class="autres-albums">
            <img src="<?= "images/" . $cd['vignette_large'] ?>" alt="<?= htmlspecialchars($auteur['nom']) ?>" style="max-width:300px;">
            <p><strong>Nom:</strong> <?= htmlspecialchars($cd['nom']) ?></p>
        </div>

        <form action="add_cart.php" method="post">
            <input type="hidden" name="id_auteur" value="<?= $auteur['vignette'] ?>">
            <input type="submit" value="Ajouter au panier">
        </form>

        <a href="index.php" class="btn btn-primary">Retour aux CDs</a>
    </main>

    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>