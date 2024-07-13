<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/panier.css">
    <title>Document</title>
</head>

<body>

    <a href="panier.php" class="link">Panier<span><?= array_sum($_SESSION['products'] ?? []) ?></span></a>
    <section class="products_list">
        <?php
        include_once "con_bdd.php";
        $req = mysqli_query($con, "SELECT * FROM produits");
        while ($row = mysqli_fetch_assoc($req)) {
        ?>
            <form action="" class="product">
                <div class="image_product">
                    <img src="photos/<?= $row['img'] ?>">
                </div>
                <div class="content">
                    <h4 class="name"><?= $row['nom'] ?></h4>
                    <h2 class="price"><?= $row['prix'] ?>FCFA</h2>
                    <a href="ajouter_panier.php?id=<?= $row['id'] ?>" class="id_product">Ajouter au panier</a>
                </div>
            </form>
        <?php } ?>
    </section>
</body>

</html>
<?php var_dump($_SESSION); ?>