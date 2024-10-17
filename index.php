<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <!-- <link rel='stylesheet' type='text/css' href='style.css'> -->
    <title>WEBSITE_TITLE</title>
</head>
<body class="container">
    

    
    <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">WEBSITE_TITLE</a>
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

            <?php
            foreach ($cds as $cd) {
                ?>

                <!--Les cartes-->
                <a href="cd.php?id_cd=<?= $cd['id'] ?>" class="col mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= "image/" . $cd['image'] ?>" class="card-img-top" alt="">
                        <div class="card-body bg-primary">
                            <h5><?= $cd['nom'] ?></h5>
                        </div>
                    </div>
                </a>                

            <?php } ?>

        </div>
    </main>
    <footer class="text-body-secondary py-5">
            <p><a href="licence.php">Les licences des images</a></p>
    </footer>

</body>
</html>



