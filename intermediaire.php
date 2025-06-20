<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=dimanche', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $numero = $_POST['numero'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $niveau = $_POST['cour'];

    // Gestion de l'image
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpPath = $_FILES['image']['tmp_name'];

        // Vérifier le type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            die("Erreur : Seuls les formats JPEG, PNG et GIF sont autorisés pour l'image.");
        }

        // Définir le chemin de destination
        $uploadDir = "uploads/";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $imagePath = $uploadDir . uniqid() . "_" . $imageName;

        // Déplacer l'image
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            die("Erreur lors du déplacement de l'image. Vérifiez les permissions du dossier 'uploads/'.");
        }
    } 

    // Gestion du CV (optionnel)
    $cvPath = "";
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $cvName = $_FILES['file']['name'];
        $cvTmpPath = $_FILES['file']['tmp_name'];
        $cvPath = $uploadDir . uniqid() . "_" . $cvName;

        if (!move_uploaded_file($cvTmpPath, $cvPath)) {
            die("Erreur lors du déplacement du CV.");
        }
    }

    // Préparer et exécuter la requête d'insertion
    $sql = "INSERT INTO amenson (numero, nom, prenom, image_path, niveau, cv_path) 
        VALUES (:numero, :nom, :prenom, :image_path, :niveau, :cv_path)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':image_path', $imagePath);
    $stmt->bindParam(':niveau', $niveau);
    $stmt->bindParam(':cv_path', $cvPath);

    try {
        $stmt->execute();
        echo "Candidat ajouté avec succès ! L'image est stockée à : " . $imagePath;
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }

    // Rediriger
header("Location: index.php");
    exit();
}
?>