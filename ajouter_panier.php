<?php
    include_once "con_bdd.php";
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['products'])){
        $_SESSION['products'] = array();
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $produit = mysqli_query($con, "SELECT * FROM produits WHERE id = $id");
        if(mysqli_num_rows($produit) == 0){ // Utilisez mysqli_num_rows pour vérifier le nombre de lignes renvoyées
            die("Ce Produit n'existe pas");
        }
        if(isset($_SESSION['products'][$id])){
            $_SESSION['products'][$id]++;
        }else{
            $_SESSION['products'][$id] = 1;
        }
        header("Location: pnier.php");
    }

    if(isset($_POST['envoyer_commande'])){
        // Vérifier si l'utilisateur est connecté ou a fourni les informations requises pour la commande (adresse, etc.)

        // Insérer les informations de la commande dans la table "commande"
        // Insérer les informations de la commande dans la table "commande"
        $id_cli = $_SESSION['client']['id']; // Remplacez par l'ID du client en fonction de votre logique de connexion
        $date_achat = date("Y-m-d"); // Obtenez la date actuelle
        $montant_total = 0; // Montant total initial (vous pouvez le mettre à jour avec le calcul approprié)

        $products = $_SESSION['products'];
        foreach($products as $id => $quantity){
            // Obtenez les informations du produit en fonction de l'ID
            $query = mysqli_query($con, "SELECT * FROM produits WHERE id = $id");
            $product = mysqli_fetch_assoc($query);

            // Calculez le montant total pour chaque produit
            $montant_produit = $product['prix'] * $quantity;
            $montant_total += $montant_produit;

            // Insérez les informations de chaque produit dans la table "commande"
            $query_insert = "INSERT INTO commander (id_cli, id_pro, quantite, montant_partiel) VALUES ($id_cli, $id, $quantity, $montant_produit)";
            mysqli_query($con, $query_insert);
        }

        // Insérez le montant total de la commande dans la table "commande"
        $query_insert_total = "INSERT INTO commande (id_cli, montant_t, date_achat) VALUES ($id_cli, $montant_total, '$date_achat')";
        mysqli_query($con, $query_insert_total);

        // Effacez la session des produits après l'envoi de la commande
        $_SESSION['products'] = array();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Envoyer la commande</title>
</head>
<body>
    <!-- Ajoutez un formulaire avec un bouton pour envoyer la commande -->
    <form method="post" action="">
        <input type="submit" name="envoyer_commande" value="Envoyer la commande">
    </form>
</body>
</html>
