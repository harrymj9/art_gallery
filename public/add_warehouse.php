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


<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Warehouse</h1>

        <!-- Formulaire de soumission d'un entrepôt -->
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
