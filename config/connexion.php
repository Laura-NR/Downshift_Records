<?php
        //Connexion à la base de données en pdo
        $pdo = new PDO('mysql:host=lakartxela.iutbayonne.univ-pau.fr;dbname=ldhildevert_bd', 'ldhildevert_bd', 'ldhildevert_bd');

        $sql = "SELECT * FROM yabontiap_categorie";
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->execute();

        $categories = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
?>