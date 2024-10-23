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
        <h1>Informations sur le nouveau CD</h1>
        <form action="process_formData.php" method="get">
            <label for="nom">Nom du CD :</label>
            <input type="text" name="nom" id="nom">
            <label for="auteur">Auteur :</label>
            <input type="text" name="auteur" id="auteur">
            <label for="vignette">Télécharger la vignete</label>
            <input type="text" name="vignette" id="vignette">
            <label for="nom">Nom du CD</label>
            <input type="text" name="nom" id="nom">

            <h2>Ajouter des chansons</h2>
            <div id="song-list"></div>
            <button type="button" onclick="addSongInput()">Ajouter une chanson</button><br>
            <input type="submit" value="Soumettre">
        </form>
    </main>
    <footer class="text-body-secondary py-5">
        <p>&copy; constant("WEBSITE_TITLE") - 'now'|date('Y') </p>
    </footer>
    <script>
        function addSongInput() {
        // Create a new div to hold the input and label
        var newDiv = document.createElement("div");

        // Create a new label for the song
        var newLabel = document.createElement("label");
        newLabel.innerHTML = "Nom de la chanson :";
        newLabel.setAttribute("for", "songs[]");

        // Create a new input field for the song
        var newInput = document.createElement("input");
        newInput.type = "text";
        newInput.name = "songs[]"; // This will create an array of song names
        newInput.id = "songs[]";

        // Append the label and input to the div
        newDiv.appendChild(newLabel);
        newDiv.appendChild(newInput);

        // Append the new div to the form where songs are listed
        document.getElementById("song-list").appendChild(newDiv);
        }
    </script>
</body>
</html>