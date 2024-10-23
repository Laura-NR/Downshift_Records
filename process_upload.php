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

// Retrieve form inputs
$nom = $_POST['nom'];
$auteur = $_POST['auteur'];
$songs = isset($_POST['songs']) ? $_POST['songs'] : [];
$durations = isset($_POST['durations']) ? $_POST['durations'] : [];

$targetDir = "images/"; 

// Debugging: Output the initial values
echo "<pre>";
echo "Nom: $nom\n";
echo "Auteur: $auteur\n";
echo "Songs: ";
print_r($songs);
echo "Durations: ";
print_r($durations);
echo "</pre>";

if (isset($_FILES["img_auteur"]) && $_FILES["img_auteur"]["error"] === 0) {
    $imgAuteurFileName = basename($_FILES["img_auteur"]["name"]);
    $imgAuteurTargetFile = $targetDir . $imgAuteurFileName;
    $imgAuteurFileType = strtolower(pathinfo($imgAuteurTargetFile, PATHINFO_EXTENSION));

    if (!move_uploaded_file($_FILES["img_auteur"]["tmp_name"], $imgAuteurTargetFile)) {
        echo "Erreur lors du téléchargement de la vignette de l'auteur.";
        exit;
    }
} else {
    echo "Le fichier de la vignette de l'auteur est manquant ou invalide.";
    exit;
}

if (isset($_FILES["vignette"]) && $_FILES["vignette"]["error"] === 0) {
    $vignetteFileName = basename($_FILES["vignette"]["name"]);
    $vignetteTargetFile = $targetDir . $vignetteFileName;
    $vignetteFileType = strtolower(pathinfo($vignetteTargetFile, PATHINFO_EXTENSION));

    if (!move_uploaded_file($_FILES["vignette"]["tmp_name"], $vignetteTargetFile)) {
        echo "Erreur lors du téléchargement de la vignette du CD.";
        exit;
    }
} else {
    echo "Le fichier de la vignette du CD est manquant ou invalide.";
    exit;
}

// Check for empty fields
if (empty($nom) || empty($auteur) || empty($songs) || empty($durations)) {
    echo "Tous les champs sont obligatoires.";
    exit;
}

try {
    $pdo->beginTransaction();

    // Check if author exists
    $stmt = $pdo->prepare("SELECT id FROM " . PREFIX . "Auteur WHERE Nom = :nom");
    $stmt->bindParam(':nom', $auteur);
    $stmt->execute();
    $auteurData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debugging: Output author data
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
        echo "New Auteur ID: $auteur_id\n"; // Debugging
    }

    // Insert CD details
    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Cd (titre, idAuteur, vignette) VALUES (:titre, :idAuteur, :vignette)");
    $stmt->bindParam(':titre', $nom);
    $stmt->bindParam(':idAuteur', $auteur_id);
    $stmt->bindParam(':vignette', $vignetteFileName);
    $stmt->execute();
    $cd_id = $pdo->lastInsertId();  
    echo "CD ID: $cd_id\n"; // Debugging

    // Prepare insert for songs
    $stmt = $pdo->prepare("INSERT INTO " . PREFIX . "Chansons (Titre, id_CD, Duree) VALUES (:titre, :id_CD, :duree)");
    for ($i = 0; $i < count($songs); $i++) {
        $song = $songs[$i];
        $duration = $durations[$i];  

        // Debugging: Output each song and duration
        echo "Inserting song: $song with duration: $duration\n";

        $stmt->bindParam(':titre', $song);
        $stmt->bindParam(':id_CD', $cd_id);
        $stmt->bindParam(':duree', $duration);
        $stmt->execute();
    }

    $pdo->commit();
    echo "CD et chansons ajoutés avec succès!";
    header('Location: admin.php');
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erreur lors de l'ajout : " . $e->getMessage();
}
?>
