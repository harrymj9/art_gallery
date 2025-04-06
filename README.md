 READ ME

Ce projet est une application web permettant aux administrateurs de gérer des œuvres d'art et leur stockage dans différents entrepôts.
 Prérequis
PHP


MySQL


Apache (avec un serveur local comme XAMPP, WAMP, ou MAMP)


Composer (si le projet utilise des dépendances PHP)


 Téléchargement du Projet
Clonez le dépôt Git ou téléchargez-le en ZIP : 
git clone https://github.com/harrymj9/art_gallery  
Ou téléchargez et extrayez l'archive dans votre dossier serveur (htdocs pour XAMPP).

Configuration de la Base de Données
Créer la base de données :


Ouvrir phpMyAdmin


Créer une base de données nommée art_gallery


Importer le fichier SQL qui se trouve dans database/art_gallery.sql


Configurer l'accès à la base :


define('DB_HOST', 'localhost' );
define('DB_NAME', 'art_gallery' );
define('DB_USER', 'root' );
define('DB_PASS', ' ' ); 

Lancement de l'Application
Démarrez Apache et MySQL dans XAMPP/WAMP.


Ouvrez un navigateur et entrez :
http://localhost/Projet1/public/index.php 



