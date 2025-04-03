<?php
// Inclure le fichier de configuration
require_once '../includes/config.php';

// Vérifier si l'ID de l'œuvre est passé dans l'URL
if (isset($_GET['id_artworks'])) {
    $id_artworks = $_GET['id_artworks'];

    // Supprimer l'œuvre de la base de données
    $query = $pdo->prepare("DELETE FROM artworks WHERE id_artworks = ?");
    $query->execute([$id_artworks]);

    // Rediriger vers la page principale après la suppression
    header('Location: index.php');
    exit();
} else {
    // Si l'ID n'est pas passé dans l'URL, rediriger vers la page principale
    header('Location: index.php');
    exit();
}
?>
