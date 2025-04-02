<?php
// Paramètres de connexion à la base de données
$host = 'localhost'; 
$db = 'art_gallery'; // Nom de la base de données
$user = 'root'; 
$pass = ''; 

// Options pour PDO
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les erreurs PDO
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
    PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation des requêtes préparées
];

try {
    // Création de la connexion PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
    // echo "Connexion réussie"; // Décommente pour tester si la connexion fonctionne
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
k
?>
