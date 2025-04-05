<?php
require_once '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $artwork_id = $_POST['artwork_id'];
    $warehouse_id = $_POST['warehouse_id'];

    $sql = "UPDATE artworks SET warehouse_id = ? WHERE id_artworks = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$warehouse_id, $artwork_id]);

    header("Location: index.php");
    exit;
}

$artworks = $pdo->query("SELECT * FROM artworks")->fetchAll();
$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Artwork to Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- le CSS intégré -->
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
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        h1 {
            color: #4E598C;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #4E598C;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3A4A6B;
        }

        .form-select, .form-control {
            border: 1px solid #4E598C;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assign Artwork to Warehouse</h1>

        <form method="POST" class="mt-4">
            <!-- la sélection de l'œuvre -->
            <div class="mb-3">
                <label for="artwork_id" class="form-label">Select Artwork</label>
                <select name="artwork_id" id="artwork_id" class="form-select" required>
                    <?php foreach ($artworks as $artwork): ?>
                        <option value="<?= $artwork['id_artworks'] ?>"><?= $artwork['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- la sélection de l'entrepôt -->
            <div class="mb-3">
                <label for="warehouse_id" class="form-label">Select Warehouse</label>
                <select name="warehouse_id" id="warehouse_id" class="form-select" required>
                    <?php foreach ($warehouses as $warehouse): ?>
                        <option value="<?= $warehouse['id_warehouses'] ?>"><?= $warehouse['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- le bouton de soumission -->
            <button type="submit" class="btn btn-primary w-100">Assign Artwork</button>
        </form>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
