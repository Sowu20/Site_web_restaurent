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
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=products", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_cli = $_POST["nom_cli"];
    $prenom_cli = $_POST["prenom_cli"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $ins = $pdo->prepare("INSERT INTO client(nom_cli, prenom_cli, adresse, telephone, email) VALUES (:nom, :prenom, :adr, :tel, :eml)");
    try {
        $ins->execute(array(
            "nom" => $nom_cli,
            "prenom" => $prenom_cli,
            "adr" => $adresse,
            "tel" => $telephone,
            "eml" => $email,
            "pa" => $pass
        ));
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . $e->getMessage();
    }
    }
    $ins = $pdo->prepare("SELECT * FROM client ORDER BY id_cl");
    $ins->execute();
    $tab = $ins->fetchAll(PDO::FETCH_ASSOC);
?>
<table class="tableau-style">
    <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Adresse</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Mot de passe</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($tab as $row): ?>
            <tr>
                <td><?= $row["id_cl"] ?></td>
                <td><?= $row["nom_cli"] ?></td>
                <td><?= $row["prenom_cli"] ?></td>
                <td><?= $row["adresse"] ?></td>
                <td><?= $row["telephone"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["pass"] ?></td>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="acceuil.html">Retour</a>
</body>
</html>