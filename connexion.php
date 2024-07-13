<?php
    require("con_bdd.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $nom = $_POST['username'];
        $req = "SELECT * FROM utilisateur WHERE username = ?";
        
        $stmt = $con->prepare($req);
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $resultat = $stmt->get_result();

        if ($resultat && $resultat->num_rows > 0) {
            $enregistrement = $resultat->fetch_assoc();
            if ($enregistrement['username'] == $_POST['username']) {
                foreach ($enregistrement as $indice => $element) {
                    if ($indice !== 'username') {
                        $_SESSION['enregistrement'][$indice] = $element;
                    }
                }
                header("Location: admin.html");
                exit();
            } else {
                echo 'Nom d\'utilisateur incorrect !';
            }
        } else {
            echo 'Veuillez vous inscrire !';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resto</title>
    <link rel="stylesheet" href="css/connexion.css"> 
    <link rel="preconnect" href="https://fonts.gestatic.com">
</head>
<body>
  <h2>Administrateur</h2>
  <form method="POST" action="connexion.php">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required><br><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br><br>

    <input type="submit" value="Se connecter">
  </form>
</body>
</html>
//<?php
// Récupérer les valeurs du formulaire
//$username == $_POST['username'];
//$password == $_POST['password'];

// Établir la connexion à la base de données
//try {
   // $pdo = new PDO('mysql:host=localhost;dbname=products', 'root', '');
   // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Effectuer les vérifications
    // Exemple : Vérifier si l'utilisateur existe dans la table "utilisateurs" avec le nom d'utilisateur et le mot de passe fournis

    // ...

    // Redirection vers une autre page si la connexion réussit
    //header('Location: ');
    //exit();
//} catch (PDOException $e) {
  //  echo 'Erreur de connexion : ' . $e->getMessage();
//}
//?>
