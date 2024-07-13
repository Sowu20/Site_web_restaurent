<?php
    $bdd = new PDO('mysql:host=localhost;dbname=products','root','');

    if (!empty($_POST['id_cli']) && !empty($_POST['id_cmd']) && !empty($_POST['id_pro']) && !empty($_POST['quantite'])) {
        $rq = $bdd->prepare('INSERT INTO commander(id_cli, id_cmd, id_pro, quantite) VALUES(:id_cli, :id_cmd, :id_pro, :quantite)');
        $rq->execute(array(
            'id_cli' => $_POST['id_cli'],
            'id_cmd' => $_POST['id_cmd'],
            'id_pro' => $_POST['id_pro'],
            'quantite' => $_POST['quantite']
        ));
        echo '<span style="color: white;">Bienvenue Mme/Mr ' . $_POST['id_cli'] . '</span>';
        echo '<span style="color: white;">Quantité : ' . $_POST['quantite'] . '</span>';
    } else {
        echo 'Tous les champs doivent être remplis.';
    }

?>

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/produit.css" rel="stylesheet">
</head>
<body>
    <section class="input_add">
        <form action="commander.php" method="POST" enctype="multipart/form-data">
            <div class="message">
                <?php
                if(isset($message)){
                    echo $message;
                }
                ?>
            </div>
            <select class="form-control" id="client" name="id_cli" required>
                <option value="">Sélectionnez le client</option>
                <?php
                try {
                    $clients_query = $bdd->query("SELECT id_cl, nom_cli FROM client");
                    while ($client = $clients_query->fetch(PDO::FETCH_ASSOC)):
                ?>
                <option value="<?php echo $client['id_cl']; ?>"><?php echo $client['nom_cli']; ?></option>
                <?php
                    endwhile;
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </select><br><br><br>
            <select class="form-control" id="produits" name="id_pro" required>
                <option value="">Sélectionnez le produit</option>
                <?php
                try {
                    $produits_query = $bdd->query("SELECT id, nom FROM produits");
                    while ($produit = $produits_query->fetch(PDO::FETCH_ASSOC)):
                ?>
                <option value="<?php echo $produit['id']; ?>"><?php echo $produit['nom']; ?></option>
                <?php
                    endwhile;
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </select><br><br><br>
            <select class="form-control" id="commande" name="id_cmd" required>
                <option value="">Sélectionnez la commande</option>
                <?php
                try {
                    $commandes_query = $bdd->query("SELECT id_cmd FROM commande");
                    while ($commande = $commandes_query->fetch(PDO::FETCH_ASSOC)):
                ?>
                <option value="<?php echo $commande['id_cmd']; ?>"><?php echo $commande['id_cmd']; ?></option>
                <?php
                    endwhile;
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </select><br><br><br>

            <input type="number" name="quantite" placeholder="Quantité achetée" required><br><br><br>
            <input type="number" name="montant_partiel" placeholder="Montant partiel" required><br><br><br>
            <input type="submit" value="Entrer">
        </form>
    </section>
</body>
</html>
