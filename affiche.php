<table border="1" width="100%">
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Image</th>
        <th>Niveau</th>
        <th>CV</th>
    </tr>
    
    <?php 
    require_once('connexion.php');
    try {
        // Préparation de la requête
        $stmt = $conn->prepare("SELECT numero, nom, prenom, image_path, niveau, cv_path FROM amenson");
        $stmt->execute();

        // On envoie la requête
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['numero']); ?></td>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Image du candidat" style="max-width: 100px;"></td>
                <td><?php echo htmlspecialchars($row['niveau']); ?></td>
                <td><?php if ($row['cv_path']) echo "<a href='" . htmlspecialchars($row['cv_path']) . "'>Voir CV</a>"; ?></td>
            </tr>
        <?php } 
    } catch (Exception $e) {
        echo "Une erreur est survenue lors de la récupération de données : " . $e->getMessage();
    } ?>
</table>

<?php
$conn = null;
?>