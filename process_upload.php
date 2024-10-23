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


$nom = $_POST['nom'];
$auteur = $_POST['auteur'];
$songs = isset($_POST['songs']) ? $_POST['songs'] : [];
$durations = isset($_POST['durations']) ? $_POST['durations'] : [];

$targetDir = "images/"; 

echo "<pre>";
echo "Nom: $nom\n";
echo "Auteur: $auteur\n";
echo "Songs: ";
print_r($songs);
echo "Durations: ";
print_r($durations);
echo "</pre>";


function handleFileUpload($fileInputName, $targetDir) {
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]["error"] === 0) {
        $fileName = basename($_FILES[$fileInputName]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            return $fileName; 
        } else {
            echo "Erreur lors du téléchargement de l'image pour " . $fileInputName;
            exit;
        }
    } else {
        echo "Le fichier pour " . $fileInputName . " est manquant ou invalide.";
        exit;
    }
}


$imgAuteurFileName = handleFileUpload("img_auteur", $targetDir);
$vignetteFileName = handleFileUpload("vignette", $targetDir);
$vignetteLargeFileName = handleFileUpload("vignette_large", $targetDir);

if (empty($nom) || empty($auteur) || empty($songs) || empty($durations)) {
    echo "Tous les champs sont obligatoires.";
    exit;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT id FROM " . PREFIX . "Auteur WHERE Nom = :nom");
    $stmt->bindParam(':nom', $auteur);
    $stmt->execute();
    $auteurData = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Auteur Data: ";
    print_r($auteurData);

    if ($auteurData) {
        $auteur_id = $auteurData['id'];
    } else {
        $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Auteur (Nom, Vignette) VALUES (:nom, :vignette)");
        $stmt->bindParam(':nom', $auteur);
        $stmt->bindParam(':vignette', $imgAuteurFileName);
        $stmt->execute();
        $auteur_id = $pdo->lastInsertId(); 
        echo "New Auteur ID: $auteur_id\n";
    }

    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Cd (titre, idAuteur, vignette, vignette_large) VALUES (:titre, :idAuteur, :vignette, :vignette_large)");
    $stmt->bindParam(':titre', $nom);
    $stmt->bindParam(':idAuteur', $auteur_id);
    $stmt->bindParam(':vignette', $vignetteFileName);
    $stmt->bindParam(':vignette_large', $vignetteLargeFileName);
    $stmt->execute();
    $cd_id = $pdo->lastInsertId();  
    echo "CD ID: $cd_id\n"; 

    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Chansons (Titre, id_CD, Duree) VALUES (:titre, :id_CD, :duree)");
    for ($i = 0; $i < count($songs); $i++) {
        $song = $songs[$i];
        $duration = $durations[$i];  

        echo "Inserting song: $song with duration: $duration\n";

        $stmt->bindParam(':titre', $song);
        $stmt->bindParam(':id_CD', $cd_id);
        $stmt->bindParam(':duree', $duration);
        $stmt->execute();
    }

    $pdo->commit();
    echo "CD et chansons ajoutés avec succès!";
    header('Location: admin.php');
    exit;
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erreur lors de l'ajout : " . $e->getMessage();
}
?>
