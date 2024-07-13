<?php
    require("con_bdd.php");

    $totalLocationsQuery = $con->query("SELECT SUM(prix) AS montant_total FROM produits");
    $totalLocations = $totalLocationsQuery->fetch();

    // Utilisation de fetch() pour récupérer le montant total
    $montantTotal = $totalLocations['montant_total'];


    // Requête pour obtenir le montant total des locations regroupé par mois et par type de location
    $totalLocationsByMonthQuery = $con->query("SELECT YEAR(date_achat) AS annee, MONTH(date_achat) AS mois, produit, SUM(prix) AS montant_total FROM acheter GROUP BY YEAR(date_achat), MONTH(date_achat), produit");

    // Requête pour obtenir la liste des locations en cours
    $locationsEnCoursQuery = $con->query("SELECT * FROM acheter WHERE date_achat >= CURDATE()");

    // Requête pour obtenir la liste des locations terminées
    $locationsTermineesQuery = $con->query("SELECT * FROM acheter WHERE date_achat < CURDATE()");
?>

<!-- Formulaire de rapport -->

<div class="entitre container">
    <h1 class="nomtitre col-12">Fiche de Rapport</h1>
</div>

<form>
    <h3>Montant Total des achats</h3>
    <p><?php echo $totalLocations; ?></p>

    <h3>Montant Total des Locations par Mois et par Produit</h3>
    <table>
        <thead>
            <tr>
                <th>Année</th>
                <th>Mois</th>
                <th>Type de Location</th>
                <th>Montant Total</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $totalLocationsByMonthQuery->fetch()) { ?>
                <tr>
                    <td><?php echo $row['annee']; ?></td>
                    <td><?php echo $row['mois']; ?></td>
                    <td><?php echo $row['produit']; ?></td>
                    <td><?php echo $row['montant_total']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h3>Liste des achats en Cours</h3>
    <table>
        <thead>
            <tr>
                <th>Produits</th>
                <th>Clients</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $locationsEnCoursQuery->fetch()) { ?>
                <tr>
                    <td><?php echo $row['produit']; ?></td>
                    <td><?php echo $row['client']; ?></td>
                    <td><?php echo $row['date_achat']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <h3>Liste des achats Terminées</h3>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Client</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $locationsTermineesQuery->fetch()) { ?>
                <tr>
                    <td><?php echo $row['produit']; ?></td>
                    <td><?php echo $row['client']; ?></td>
                    <td><?php echo $row['date_achat']; ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</form>
