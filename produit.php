<?php
    include_once "con_bdd.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prix = $_POST["prix"];
    $nom = $_POST["nom"];
    if (!empty($prix) && !empty($nom)) {
        $req1 = mysqli_query($con, "SELECT prix FROM produits WHERE prix ='$prix' AND nom ='$nom'");
        if (mysqli_num_rows($req1) > 0) {
            $message = '<p style="color:red">Le produit existe déjà</p>';
        } else {
            if(isset($_FILES['img'])){
                $img_nom = $_FILES['img']['name'];
                $tmp_nom = $_FILES['img']['tmp_name'];
                $time =time();
                $nouveau_nom_img = $time.$img_nom ;
                $deplacer_image = move_uploaded_file($tmp_nom, "photos/".$nouveau_nom_img) ;
                if($deplacer_image){
                    $req2 = mysqli_query($con, "INSERT INTO produits (prix, nom, img) VALUES ('$prix', '$nom', '$nouveau_nom_img')");
                    if($req2){
                        $message = '<p style="color:green">Produit  ajouté !</p>';

                    }else{
                        $message = '<p style="color:red">Produit non ajouté! </p>';
                    }
                }
            }
        }
    }else {
        $message = '<p style="color:green">Veuillez remplir tous les champs !</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>produit</title>
    <link href="css/produit.css" rel="stylesheet">
</head>
<body>
    <section class="input_add">
        <form action="produit.php" method="POST" enctype="multipart/form-data">
            <div class="message">
                <?php
                if(isset($message)){
                    echo $message ;
                }
                ?>
            </div>
           
            <label>Image du produit</label>
            <input type="file" name="img" placeholder="Image" required><br><br>
            <input type="number" name="prix" placeholder="Prix" required><br><br>
            <input type="text" name="nom" placeholder="Nom" required><br><br>
            <input type="submit" value="Ajouter" name="btn-ajouter">
            <a class="btn-liste-prod" href="pnier.php"> Listes des produits</a>


        </form>
    </section>
</body>
</html>