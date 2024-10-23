<?php
session_start();
require_once 'include.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id_cd']) && is_numeric($_GET['id_cd'])) {
    $cd_id = $_GET['id_cd'];

    $sql = "SELECT * FROM " . PREFIX . "cd WHERE id = :id";
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
        <h1>Détails du CD: <?= htmlspecialchars($cd['nom']) ?></h1>

        <div class="cd-details">
            <img src="<?= "image/" . $cd['image'] ?>" alt="<?= htmlspecialchars($cd['nom']) ?>" style="max-width:300px;">
            <p><strong>Nom:</strong> <?= htmlspecialchars($cd['nom']) ?></p>
            <p><strong>Artiste:</strong> <?= htmlspecialchars($cd['artiste']) ?></p>
            <p><strong>Date de Sortie:</strong> <?= htmlspecialchars($cd['date_sortie']) ?></p>
            <p><strong>Genre:</strong> <?= htmlspecialchars($cd['genre']) ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($cd['description']) ?></p>
        </div>

        <a href="index.php" class="btn btn-primary">Retour aux CDs</a>
    </main>

    <footer class="text-body-secondary py-5">
        <p>&copy; <?= constant('WEBSITE_TITLE') ?> - <?= date('Y') ?></p>
    </footer>
</body>

</html>