<?php
require_once '../includes/config.php';
include '../includes/header.php';

// La vérification si un id_warehouse est passé en paramètre
if (!isset($_GET['id_warehouse']) || empty($_GET['id_warehouse'])) {
    echo "<p>Invalid warehouse ID.</p>";
    exit;
}

$id_warehouse = $_GET['id_warehouse'];

// Ici la récupération des informations de l'entrepôt
$query = $pdo->prepare("SELECT * FROM warehouses WHERE id_warehouses = ?");
$query->execute([$id_warehouse]);
$warehouse = $query->fetch(PDO::FETCH_ASSOC);

if (!$warehouse) {
    echo "<p>Warehouse not found.</p>";
    exit;
}

// Ici la récupération de toutes les œuvres associées à cet entrepôt
$query = $pdo->prepare("SELECT * FROM artworks WHERE warehouse_id = ?");
$query->execute([$id_warehouse]);
$artworks = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!--le style css -->
    <style>
        body {
            background-color: #F9C784;
            color: #4E598C;
            font-family: 'Arial', sans-serif;
        }

        .container {
            background-color: #FFFFFF;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            margin-top: 50px;
        }

        h1, h2 {
            color: #4E598C;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            text-align: center;
        }

        th {
            background-color: #4E598C;
            color: #FFFFFF;
        }

        td {
            background-color: #F9C784;
        }

        .btn-secondary {
            background-color: #4E598C;
            border: none;
            color: #FFFFFF;
            width: 100%;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .btn-secondary:hover {
            background-color: #3A4A6B;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Warehouse: <?= htmlspecialchars($warehouse['name']) ?></h1>
        <p><strong>Address:</strong> <?= htmlspecialchars($warehouse['address']) ?></p>

        <h2 class="mt-4">Stored Artworks</h2>
        <?php if (count($artworks) > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Year</th>
                        <th>Size (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($artworks as $artwork): ?>
                        <tr>
                            <td><?= htmlspecialchars($artwork['title']) ?></td>
                            <td><?= htmlspecialchars($artwork['artist']) ?></td>
                            <td><?= htmlspecialchars($artwork['year']) ?></td>
                            <td><?= htmlspecialchars($artwork['width']) ?> x <?= htmlspecialchars($artwork['height']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No artworks stored in this warehouse.</p>
        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <!-- Lien vers le JS de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
