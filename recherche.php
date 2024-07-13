<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form action=".php" method="GET">
    <input type="date" name="date_achat" placeholder="Entrez votre date">
    <input type="submit" value="Rechercher">
  </form>

  <?php
    if(isset($_GET['date_achat'])) {
      $terme = $_GET['date_achat'];
      // Effectuer le traitement de recherche ici
      // Connexion à la base de données
      $connexion = mysqli_connect("localhost", "root", "", "products");

      // Échapper les caractères spéciaux pour éviter les failles d'injection SQL
      $terme = mysqli_real_escape_string($connexion, $terme);

      // Requête de recherche
      $requete = "SELECT * FROM commande WHERE date_achat LIKE '%$terme%'";

      // Exécution de la requête
      $resultat = mysqli_query($connexion, $requete);

      // Traitement des résultats
      while ($row = mysqli_fetch_assoc($resultat)) {
        // Afficher les résultats ou effectuer d'autres opérations
      }

      // Fermer la connexion à la base de données
      mysqli_close($connexion);
    }
  ?>

</body>
</html>
