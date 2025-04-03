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
    $artist = $_POST['artist'];  // Remplacement de artist_name par artist
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
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Artwork</h1>

        <!-- Formulaire de modification de l'œuvre -->
        <form action="edit_artwork.php?id_artworks=<?php echo $artwork['id_artworks']; ?>" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($artwork['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" id="year" name="year" class="form-control" value="<?php echo htmlspecialchars($artwork['year']); ?>" required>
            </div>

            <div class="form-group">
                <label for="artist">Artist:</label> <!-- Changement ici, il doit rester "artist" -->
                <input type="text" id="artist" name="artist" class="form-control" value="<?php echo htmlspecialchars($artwork['artist']); ?>" required>
            </div>

            <div class="form-group">
                <label for="width">Width (in cm):</label>
                <input type="number" step="0.01" id="width" name="width" class="form-control" value="<?php echo htmlspecialchars($artwork['width']); ?>" required>
            </div>

            <div class="form-group">
                <label for="height">Height (in cm):</label>
                <input type="number" step="0.01" id="height" name="height" class="form-control" value="<?php echo htmlspecialchars($artwork['height']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update Artwork</button>
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
