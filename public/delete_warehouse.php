<?php

require_once '../includes/config.php';


if (isset($_GET['id_warehouses'])) {
    $id_warehouses = $_GET['id_warehouses'];

   
    $query = $pdo->prepare("DELETE FROM warehouses WHERE id_warehouses = ?");
    $query->execute([$id_warehouses]);

   
    header('Location: index.php');
    exit();
} else {
   
    header('Location: index.php');
    exit();
}
?>
