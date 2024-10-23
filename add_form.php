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
        <form action="process_upload.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="auteur">Auteur :</label>
                <input type="text" name="auteur" id="auteur">
                <label for="img_auteur">Vignette de l'Auteur :</label>
                <input type="file" name="img_auteur" id="img_auteur">
            </div>
            <label for="nom">Nom du CD :</label>
            <input type="text" name="nom" id="nom">
            <label for="vignette">Télécharger la vignete (image plus petite) :</label>
            <input type="file" name="vignette" id="vignette">
            <label for="vignette_large">Télécharger l'aperçu du CD (image plus large) :</label>
            <input type="file" name="vignette_large" id="vignette_large">

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
            var newDiv = document.createElement("div");

            var newLabel = document.createElement("label");
            newLabel.innerHTML = "Nom de la chanson :";
            newLabel.setAttribute("for", "songs[]");

            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.name = "songs[]";
            newInput.id = "songs[]";

            var newLabelDuration = document.createElement("label");
            newLabelDuration.innerHTML = "Durée de la chanson (mm:ss):";
            newLabelDuration.setAttribute("for", "durations[]");

            var newInputDuration = document.createElement("input");
            newInputDuration.type = "text";
            newInputDuration.name = "durations[]";
            newInputDuration.id = "durations[]";
            newInputDuration.placeholder = "00:00";


            newDiv.appendChild(newLabel);
            newDiv.appendChild(newInput);
            newDiv.appendChild(newLabelDuration);
            newDiv.appendChild(newInputDuration);


            document.getElementById("song-list").appendChild(newDiv);
        }
    </script>
</body>

</html>