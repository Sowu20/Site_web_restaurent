<?php
  session_start();
?>

<?php
  $bdd = new PDO('mysql:host=localhost;dbname=products','root','');

  if (!empty($_POST['nom_cli']) && !empty($_POST['prenom_cli']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['email'])) {
      $rq = $bdd->prepare('INSERT INTO client(id_cl, nom_cli, prenom_cli, adresse, telephone, email, pass) VALUES(NULL, :nom, :prenom, :adresse, :telephone, :email, :pass)');
      $rq->execute(array(
          'nom' => $_POST['nom_cli'],
          'prenom' => $_POST['prenom_cli'],
          'adresse' => $_POST['adresse'],
          'telephone' => $_POST['telephone'],
          'email' => $_POST['email'],
          'pass' => $_POST['pass']
      ));

      echo 'Bienvenue Mme/Mr  ' . $_POST['nom_cli'] . '';
      echo ' ' . $_POST['prenom_cli'] . '<br>';

      
  } else {
      echo 'Tous les champs doivent être remplis.';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reservation.css">
    <title>Réservation</title>
  
</head>
<body>
  <div class="nav">
  <h1> Client</h1>
  <section id="contact">
 </div>
  </section>
  <section class="contact" id="contact">
    <form method="POST" action="commande.php">
    <div class="contactform">
      <input type="text" name="nom_cli" placeholder="Nom du client" required><br>
      <input type="text" name="prenom_cli" placeholder="Prénoms du client" required><br>
      <input type="text" name="adresse" placeholder="Adresse" required><br>
      <input type="number" name="telephone" placeholder="Telephone" required><br>
      <input type="email" name="email" placeholder="you@gmail.com" required><br>
      <input type="password" name="pass" placeholder="Mot de passe" required><br>
      <input type="submit" value="Entrer">
        </div>
    </div>
  </form>
</diV> 
    
    <button class="btn"><a href="index.php">Retour</a></button>

</section>
</body>
</html>