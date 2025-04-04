<?php

require_once '../includes/config.php';


if (isset($_GET['id_artworks'])) {
    $id_artworks = $_GET['id_artworks'];

  
    $query = $pdo->prepare("DELETE FROM artworks WHERE id_artworks = ?");
    $query->execute([$id_artworks]);

    header('Location: index.php');
    exit();
} else {
    
    header('Location: index.php');
    exit();
}
?>
