<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="liste_cli.css">
    <title>Achats</title>
</head>
<body>

<?php
    $bdd = new PDO('mysql:host=localhost;dbname=products','root','');

    if (!empty($_POST['id_cmd']) && !empty($_POST['id_cli']) && !empty($_POST['date_achat'] && !empty($_POST['montant_t']))) {
        $rq = $bdd->prepare('INSERT INTO commander(id_cmd, id_cli, date_achat, montant_t) VALUES(:id_cmd, :id_cli, :date_achat, :montant_t)');
        $rq->execute(array(
            'id_cmd' => $_POST['id_cmd'],
            'id_cli' => $_POST['id_cli'],
            'date_achat' => $_POST['date_achat'],
            'montant_t' => $_POST['montant_t']
        ));

        echo 'Bienvenue Mme/Mr ' . $_POST['id_cli'] . '<br>';
        echo 'Quantité : ' . $_POST['date_achat'] . '<br>';
    } else {
        echo '';
    }

?>

<?php
    session_start();
?>

<?php
    $ins = $bdd->prepare("SELECT nom_cli, prenom_cli, date_achat, montant_t FROM client, commande WHERE client.id_cl=commande.id_cli");
    $ins->execute();
    $tab = $ins->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="tableau-style">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date d'achat</th>
            <th>Montant total</th>
            <th>Valider</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tab as $row): ?>
            <tr>
                <td><?= $row["nom_cli"] ?></td>
                <td><?= $row["prenom_cli"] ?></td>
                <td><?= $row["date_achat"] ?></td>
                <td><?= $row["montant_t"] ?></td>
                <th><input type="checkbox" name="$total"></th>
                <td><a href="panier.php?del=<?=$product['id']?>"><img src="photos/delete.jpeg" style="height:35px;width: 35px;"></a></td>
                <!--<td><a href="supprimer.php?id_cl=<?=$row['id_cl']?>"><img src="photos/delete.jpeg" style="height:35px;width: 35px;"/></a></td> -->

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="acceuil.html">Retour</a>

</body>
</html>
