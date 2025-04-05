<?php
// l'inclusion du fichier de configuration
require_once '../includes/config.php';
include '../includes/header.php';

// la récupération des œuvres
$artworksQuery = $pdo->query("SELECT * FROM artworks");
$artworks = $artworksQuery->fetchAll(PDO::FETCH_ASSOC);

// la récupération des entrepôts
$warehousesQuery = $pdo->query("SELECT * FROM warehouses");
$warehouses = $warehousesQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Art Dashboard</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- le CSS intégré -->
    <style>
        body {
            background-color: #F9C784;
            color: #4E598C;
            font-family: 'Arial', sans-serif;
        }

        h1, h2 {
            color: #4E598C;
            text-align: center;
        }

        .container {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            background-color: #FFFFFF;
            border: 1px solid #4E598C;
            color: #4E598C;
        }

        .btn-primary {
            background-color: #4E598C;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3A4A6B;
        }

        .btn-warning {
            background-color: #F9C784;
            border: none;
            color: #4E598C;
        }

        .btn-warning:hover {
            background-color: #E8B06E;
        }

        .btn-danger {
            background-color: #D9534F;
            border: none;
        }

        .btn-danger:hover {
            background-color: #C9302C;
        }

        .btn-success {
            background-color: #5CB85C;
            border: none;
        }

        .btn-success:hover {
            background-color: #4CAE4C;
        }

        .btn-info {
            background-color: #5BC0DE;
            border: none;
        }

        .btn-info:hover {
            background-color: #31B0D5;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Gallery Art Dashboard</h1>

        <!-- Section des œuvres -->
        <h2 class="mt-4">Artworks</h2>
        <ul class="list-group">
            <?php foreach ($artworks as $artwork) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($artwork['title']); ?>
                    <span class="ml-3">
                        <a href="edit_artwork.php?id_artworks=<?php echo $artwork['id_artworks']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_artwork.php?id_artworks=<?php echo $artwork['id_artworks']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this artwork?')">Delete</a>
                        <a href="assign_artwork_to_warehouse.php?id_artworks=<?php echo $artwork['id_artworks']; ?>" class="btn btn-success btn-sm">Assign</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Ble bouton pour assigner une œuvre -->
        <div class="mt-4 text-center">
            <a href="assign_artwork_to_warehouse.php" class="btn btn-primary">Assign an Artwork to a Warehouse</a>
        </div>

        <!-- la section des entrepôts -->
        <h2 class="mt-4">Warehouses</h2>
        <ul class="list-group">
            <?php foreach ($warehouses as $warehouse) : ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($warehouse['name']); ?>
                    <span class="ml-3">
                        <a href="edit_warehouse.php?id_warehouses=<?php echo $warehouse['id_warehouses']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_warehouse.php?id_warehouses=<?php echo $warehouse['id_warehouses']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure you want to delete this warehouse?')">Delete</a>
                        <a href="view_warehouse.php?id_warehouse=<?php echo $warehouse['id_warehouses']; ?>" class="btn btn-info btn-sm">View Artworks</a>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
