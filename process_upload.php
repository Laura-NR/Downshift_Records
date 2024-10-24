<?php
session_start();
ob_start();
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
$prix = $_POST['prix'];

$targetDir = "images/";


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


$stmt = $pdo->prepare("SELECT id FROM " . PREFIX . "Auteur WHERE Nom = :nom");
$stmt->bindParam(':nom', $auteur);
$stmt->execute();
$auteurData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($auteurData) {
    $auteur_id = $auteurData['id'];
} else {
    $imgAuteurFileName = handleFileUpload("img_auteur", $targetDir);
    
    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Auteur (Nom, Vignette) VALUES (:nom, :vignette)");
    $stmt->bindParam(':nom', $auteur);
    $stmt->bindParam(':vignette', $imgAuteurFileName);
    $stmt->execute();
    $auteur_id = $pdo->lastInsertId(); 
}

$vignetteFileName = handleFileUpload("vignette", $targetDir);
$vignetteLargeFileName = handleFileUpload("vignette_large", $targetDir);

if (empty($nom) || empty($auteur) || empty($songs) || empty($durations)) {
    echo "Tous les champs sont obligatoires.";
    exit;
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Cd (titre, idAuteur, vignette, vignette_large, prix) VALUES (:titre, :idAuteur, :vignette, :vignette_large, :prix)");
    $stmt->bindParam(':titre', $nom);
    $stmt->bindParam(':idAuteur', $auteur_id);
    $stmt->bindParam(':vignette', $vignetteFileName);
    $stmt->bindParam(':vignette_large', $vignetteLargeFileName);
    $stmt->bindParam(':prix', $prix);
    $stmt->execute();
    $cd_id = $pdo->lastInsertId(); 

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
    ob_end_flush(); 
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erreur lors de l'ajout : " . $e->getMessage();
}
?>
