<?php
// Inclure le fichier de configuration
require_once '../includes/config.php';

// Vérifier si l'ID de l'entrepôt est passé dans l'URL
if (isset($_GET['id_warehouses'])) {
    $id_warehouses = $_GET['id_warehouses'];

    // Récupérer l'entrepôt depuis la base de données
    $query = $pdo->prepare("SELECT * FROM warehouses WHERE id_warehouses = ?");
    $query->execute([$id_warehouses]);
    $warehouse = $query->fetch(PDO::FETCH_ASSOC);

    if (!$warehouse) {
        // Si l'entrepôt n'existe pas, rediriger vers la page principale
        header('Location: index.php');
        exit();
    }
} else {
    // Si l'ID n'est pas passé dans l'URL, rediriger vers la page principale
    header('Location: index.php');
    exit();
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Mettre à jour l'entrepôt dans la base de données
    $query = $pdo->prepare("UPDATE warehouses SET name = ?, address = ? WHERE id_warehouses = ?");
    $query->execute([$name, $address, $id_warehouses]);

    // Rediriger vers la page principale après la mise à jour
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warehouse</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Warehouse</h1>

        <!-- Formulaire de modification de l'entrepôt -->
        <form action="edit_warehouse.php?id_warehouses=<?php echo $warehouse['id_warehouses']; ?>" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($warehouse['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($warehouse['address']); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Update Warehouse</button>
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
