<?php
    require("con_bdd.php");
    if(!$con){
        die("Erreur de connexion :" . mysqli_connect_error());
    }
    $id = $_GET['id_cl'];
    $req = mysqli_query($con, "DELETE FROM client WHERE id_cl= $id");
    header("Location: acheter.php");
    mysqli_close($con);
?>