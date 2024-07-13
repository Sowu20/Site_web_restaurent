<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "products";

    $con = mysqli_connect($host, $user, $password, $database);

    if (!$con) {
        die('Erreur : ' . mysqli_connect_error());
    }

    // echo "Connexion réussie!";
?>
