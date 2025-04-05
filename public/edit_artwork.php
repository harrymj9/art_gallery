<?php
// Inclure le fichier de configuration
require_once '../includes/config.php';

// Vérifier si l'ID de l'œuvre est passé dans l'URL
if (isset($_GET['id_artworks'])) {
    $id_artworks = $_GET['id_artworks'];

    // Récupérer l'œuvre depuis la base de données
    $query = $pdo->prepare("SELECT * FROM artworks WHERE id_artworks = ?");
    $query->execute([$id_artworks]);
    $artwork = $query->fetch(PDO::FETCH_ASSOC);

    if (!$artwork) {
        // Si l'œuvre n'existe pas, rediriger vers la page principale
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
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];  
    $width = $_POST['width'];
    $height = $_POST['height'];

    // Mettre à jour l'œuvre dans la base de données
    $query = $pdo->prepare("UPDATE artworks SET title = ?, year = ?, artist = ?, width = ?, height = ? WHERE id_artworks = ?");
    $query->execute([$title, $year, $artist, $width, $height, $id_artworks]);

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
    <title>Edit Artwork</title>
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

        .form-control {
            border: 1px solid #4E598C;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Artwork</h1>

        <!-- le formulaire de modification de l'œuvre -->
        <form action="edit_artwork.php?id_artworks=<?php echo $artwork['id_artworks']; ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($artwork['title']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <input type="number" id="year" name="year" class="form-control" value="<?php echo htmlspecialchars($artwork['year']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="artist" class="form-label">Artist:</label>
                <input type="text" id="artist" name="artist" class="form-control" value="<?php echo htmlspecialchars($artwork['artist']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="width" class="form-label">Width (in cm):</label>
                <input type="number" step="0.01" id="width" name="width" class="form-control" value="<?php echo htmlspecialchars($artwork['width']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="height" class="form-label">Height (in cm):</label>
                <input type="number" step="0.01" id="height" name="height" class="form-control" value="<?php echo htmlspecialchars($artwork['height']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Artwork</button>
        </form>

        <!-- le bouton de retour -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary w-100">Back to Dashboard</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
