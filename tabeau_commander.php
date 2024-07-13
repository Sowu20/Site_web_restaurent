<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/liste_cli.css">
    <title>Document</title>
</head>
<body>
    <?php
        $bdd = new PDO('mysql:host=localhost;dbname=products','root','');

        if (!empty($_POST['id_cli']) && !empty($_POST['id_pro']) && !empty($_POST['quantite'])) {
            $rq = $bdd->prepare('INSERT INTO commander(id_cli, id_pro, quantite) VALUES(:id_cli, :id_pro, :quantite)');
            $rq->execute(array(
                'id_cli' => $_POST['id_cli'],
                'id_pro' => $_POST['id_pro'],
                'quantite' => $_POST['quantite']
            ));

            echo 'Bienvenue Mme/Mr ' . $_POST['id_cli'] . '<br>';
            echo 'Quantité : ' . $_POST['quantite'] . '<br>';
        } else {
            echo '';
        }

    ?>

    <?php
        session_start();
    ?>

    <?php
        $ins = $bdd->prepare("SELECT nom_cli, prenom_cli, nom, quantite,montant_partiel FROM client, commande, produits, commander WHERE client.id_cl=commander.id_cli AND produits.id=commander.id_pro AND client.id_cl=commande.id_cli");
        $ins->execute();
        $tab = $ins->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="tableau-style">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Montant partiel</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $row): ?>
                <tr>
                    <td><?= $row["nom_cli"] ?></td>
                    <td><?= $row["prenom_cli"] ?></td>
                    <td><?= $row["nom"] ?></td>
                    <td><?= $row["quantite"] ?></td>
                    <td><?= $row["montant_partiel"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="acceuil.html">Retour</a>

</body>
</html>
