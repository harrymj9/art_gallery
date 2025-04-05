<?php
require_once '../includes/config.php';
include '../includes/header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $warehouse_id = $_POST['warehouse_id'];

    $sql = "INSERT INTO artworks (title, year, artist, width, height, warehouse_id)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $year, $artist, $width, $height, $warehouse_id]);

    header("Location: index.php");
    exit;
}

$warehouses = $pdo->query("SELECT * FROM warehouses")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artwork</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!--ici l'intégration du ccs-->
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

        .btn-secondary {
            background-color: #F9C784;
            border: none;
            color: #4E598C;
        }

        .btn-secondary:hover {
            background-color: #E8B06E;
        }

        .form-control {
            border: 1px solid #4E598C;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Add New Artwork</h1>

        <!-- le formulaire de soumission d'une nouvelle œuvre -->
        <form method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="artist">Artist:</label>
                <input type="text" name="artist" id="artist" class="form-control">
            </div>

            <div class="form-group">
                <label for="width">Width (cm):</label>
                <input type="number" name="width" id="width" step="0.01" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="height">Height (cm):</label>
                <input type="number" name="height" id="height" step="0.01" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="warehouse_id">Assign to Warehouse:</label>
                <select name="warehouse_id" id="warehouse_id" class="form-control" required>
                    <?php foreach ($warehouses as $warehouse): ?>
                        <option value="<?= $warehouse['id_warehouses'] ?>"><?= htmlspecialchars($warehouse['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add Artwork</button>
        </form>

        <!-- le bouton de retour -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary btn-block">Back to Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
