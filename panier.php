<?php
    session_start();
    include_once "con_bdd.php";
    if(isset($_GET['del'])){
        $id_del = $_GET['del'] ;
        unset($_SESSION['products'][$id_del]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/panier.css">
</head>
<body class="panier">
    <a href="pnier.php" class="link">Boutique</a>
    <section>
        <table>
            <tr>
                <th></th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
            <?php
            $total = 0;
            $ids = array_keys($_SESSION['products']);
            if(empty($ids)){
              echo"  Votre panier est vide";
            }else {
                $produits = mysqli_query($con, "SELECT * FROM produits WHERE id IN (".implode(',', $ids).")");
                foreach($produits as $product):
                  $total = $total + $product['prix'] * $_SESSION['products'][$product['id']] ;
            ?>
            <tr>
                <td><img src="photos/<?=$product['img']?>"></td>
                <td><?=$product['nom']?></td>
                <td><?=$product['prix']?>FCFA</td>
                <td><?=$_SESSION['products'][$product['id']]?></td>
                <td><a href="panier.php?del=<?=$product['id']?>"><img src="photos/delete.jpeg"></a></td>
            </tr>
            <?php endforeach;} ?>
            <tr>
                
            </tr>
            <tr class="total">
                <th>Total : <?=$total?>FCFA</th>

            </tr>
        </table>
    </section> 
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
    //$id_cli = $_GET['id_cli'];
    $id_cli =  $_SESSION['enregistrement']['id_cl']; // Remplacez par l'ID du client en fonction de votre logique de connexion
    $date_achat = date("Y-m-d"); // Obtenez la date actuelle
    $montant_total = 0;

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
    <!-- Ajoutez un formulaire avec un bouton pour envoyer la commande -->
    <form method="post" action="">
        <input type="submit" name="envoyer_commande" value=" Payer">
    </form>

</body>
</html>