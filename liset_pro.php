<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="liste_cli.css">
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
$img = $_POST["img"];
$prix = $_POST["prix"];
$nom = $_POST["nom"];
$ins = $pdo->prepare("INSERT INTO produits(img, prix,nom) VALUES (:im, :pr, :nm)");
try {
    $ins->execute(array(
        "im" => $im,
        "pr" => $prix,
        "nm" => $nom
    ));
} catch (PDOException $e) {
    echo "Erreur lors de l'insertion : " . $e->getMessage();
}
}

$ins = $pdo->prepare("SELECT * FROM produits ORDER BY id");
$ins->execute();
$tab = $ins->fetchAll(PDO::FETCH_ASSOC);
?>

    <table class="tableau-style">
        <thead>
            <tr>
                <th>N°</th>
                <th>Images</th>
                <th>Prix</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $row): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["img"] ?></td>
                    <td><?= $row["prix"] ?></td>
                    <td><?= $row["nom"] ?></td>
    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="acceuil.html">Retour</a>

</body>
</html>



