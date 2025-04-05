<?php

require_once '../includes/config.php';

// Vérifie si l'ID de l'entrepôt est passé dans l'URL
if (isset($_GET['id_warehouses'])) {
    $id_warehouses = $_GET['id_warehouses'];

    // Récupére l'entrepôt depuis la base de données
    $query = $pdo->prepare("SELECT * FROM warehouses WHERE id_warehouses = ?");
    $query->execute([$id_warehouses]);
    $warehouse = $query->fetch(PDO::FETCH_ASSOC);

    if (!$warehouse) {
        // Si l'entrepôt n'existe pas, il va nous rediriger vers la page principale
        header('Location: index.php');
        exit();
    }
} else {
    // si l'ID n'est pas passé dans l'URL, il va nous rediriger vers la page principale
    header('Location: index.php');
    exit();
}

// le traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    // la mise à jour l'entrepôt dans la base de données
    $query = $pdo->prepare("UPDATE warehouses SET name = ?, address = ? WHERE id_warehouses = ?");
    $query->execute([$name, $address, $id_warehouses]);

    // redirection vers la page principale après la mise à jour
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
  
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS intégré -->
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

        .btn-secondary {
            background-color: #F9C784; 
            border: none;
        }

        .btn-secondary:hover {
            background-color: #E0B360;
        }

        .form-control {
            border: 1px solid #4E598C; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Warehouse</h1>

        <!-- le formulaire de modification de l'entrepôt -->
        <form action="edit_warehouse.php?id_warehouses=<?php echo $warehouse['id_warehouses']; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($warehouse['name']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" class="form-control" value="<?php echo htmlspecialchars($warehouse['address']); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">Update Warehouse</button>
        </form>

        <!-- le bouton de retour -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary w-100">Back to Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
