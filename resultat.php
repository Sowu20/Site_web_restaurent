<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/produit.css" rel="stylesheet">

</head>
<body>
    <div class="result">
       <div class="result-content">
        <a href="produit.php">Ajouter un produit</a>
        <h3>Liste des produits</h3>
        <div class="liste-produits">
            <?php
            $con = mysqli_connect("localhost","root","","products");
            $req3 = mysqli_query($con, "SELECT * FROM produits");
            if(mysqli_num_rows($req3) == 0){
                echo 'Aucun produit trouvé';
            }else{
                while($row = mysqli_fetch_assoc($req3)){
                    echo '
                    
         <div class="produit">
         <div class="image-prod">
             <img src="photos/"'.$row['img'].'" alt="">
         </div>
      
      <div class="text">
         <strong><p class="prix">'.$row['prix'].'FCFA</p></strong>
         <p class="nom">'.$row['nom'].'</p>
     </div>
      </div> 
                    ';
                }
            }
            ?>

        </div>
    </div>
       </div> 
</body>
</html>