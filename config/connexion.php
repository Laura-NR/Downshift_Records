<?php
        //Connexion à la base de données en pdo
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" .DB_NAME . ", " . DB_USER . ", " . DB_PASSWORD . "");

        $sql = "SELECT * FROM record_cd";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        $cd = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
?>