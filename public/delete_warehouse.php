<?php
// Inclure le fichier de configuration
require_once '../includes/config.php';

// Vérifier si l'ID de l'entrepôt est passé dans l'URL
if (isset($_GET['id_warehouses'])) {
    $id_warehouses = $_GET['id_warehouses'];

    // Supprimer l'entrepôt de la base de données
    $query = $pdo->prepare("DELETE FROM warehouses WHERE id_warehouses = ?");
    $query->execute([$id_warehouses]);

    // Rediriger vers la page principale après la suppression
    header('Location: index.php');
    exit();
} else {
    // Si l'ID n'est pas passé dans l'URL, rediriger vers la page principale
    header('Location: index.php');
    exit();
}
?>
