

<?php
require("con_bdd.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nom = $_POST['nom_cli'];
    $req = "SELECT * FROM client WHERE nom_cli = '$nom';";
    
    $resultat =$con->query($req);

    if ($resultat and $resultat->num_rows > 0) {
        $enregistrement = $resultat->fetch_assoc();
        if ($enregistrement['pass'] == $_POST['passe']) {
            foreach ($enregistrement as $indice => $element) {
                if ($indice != 'pass') {
                    $_SESSION['enregistrement'][$indice] = $element;
                }
            }
            header("location:pnier.php");
        }
    }else{
    echo'veuillez vous inscrire!';
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reservation.css">
    <title></title>
  
</head>
<body>
    <div class="nav">
        <h1> Client</h1>
        <section id="">
            </div>
        </section>
        <section class="contact" id="contact">
            <form method="POST" action="">
                <div class="contactform">
                    <input type="text" name="nom_cli" placeholder="Nom du client" required><br>
                    <input type="text" name="passe" placeholder="Mot de passe" ><br>
                    <input type="submit" value="Entrer">
                </div>  
            </form>
        </diV> 
    
    <button class="btn"><a href="index.php">Retour</a></button>

        </section>
</body>
</html>