<?php
require_once '../includes/config.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $sql = "INSERT INTO warehouses (name, address) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $address]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Warehouse</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
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
        <h1>Add New Warehouse</h1>

        <!-- le formulaire de soumission d'un entrepôt -->
        <form method="POST">
            <div class="form-group">
                <label for="name">Warehouse Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Add Warehouse</button>
        </form>

        <!-- le bouton de retour -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary btn-block">Back to Dashboard</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
