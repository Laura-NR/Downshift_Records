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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un CD</title>
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
        <form action="process_upload.php">
            <label for="title">Titre</label>
            <input type="text" name="title" id="title">
            <label for="artist">Artiste</label>
            <input type="text" name="artist" id="artist">
            <label for="year">Année</label>
            <input type="number" name="year" id="year">
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre">
            <label for="price">Prix</label>
            <input type="number" name="price" id="price">
            <label for="cover">Pochette</label>
            <input type="file" name="cover" id="cover">
            <label for="chansons">Combien de chansons sont-ils inclus dans le CD ?</label>
            <input type="number" name="chansons" id="chansons">
            <button type="submit">Ajouter</button>
        </form>
    </main>
</body>
</html>