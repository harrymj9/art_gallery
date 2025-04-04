<?php
// l'inclusion du fichier de configuration
require_once '../includes/config.php';
include '../includes/header.php';


// Récupéreration de  la liste des œuvres
$artworksQuery = $pdo->query("SELECT * FROM artworks");
$artworks = $artworksQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer  de la liste des entrepôts
$warehousesQuery = $pdo->query("SELECT * FROM warehouses");
$warehouses = $warehousesQuery->fetchAll(PDO::FETCH_ASSOC);
?>


<body>
    <div class="container mt-5">
        <h1 class="text-center">Gallery_art Dashboard</h1>

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
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Section des entrepôts -->
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
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
