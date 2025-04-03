<?php
require_once '../includes/config.php';


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
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Artwork</h1>

        <!-- Formulaire de soumission d'une nouvelle œuvre -->
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

        <!-- Bouton de retour -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary btn-block">Back to Dashboard</a>
        </div>
    </div>

    <!-- Lien vers les scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
