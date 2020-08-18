<?php
        require_once('db.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Suivis changement d'ampoule</title>
</head>
<body>
<div id="container">
    <div class="cadre">
    <h1>Suivi changement d'ampoule </h1>
    <div class="lien">
        <p><a href="edit.php">Ajouter</a></p>
        <p><a href ="deco.php"> Déconnexion </a></p>
    </div>
    <table>
        <tr>
            <th>Date</th>
            <th>Étage</th>
            <th>Position</th>
            <th>Puissance</th>
            <th>Marque</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
//Préparation de requête
            $sql = 'SELECT id, date_changement, etage, position, puissance, marque FROM gardien';
            $sth = $dbh->prepare($sql);
//Execution
            $sth->execute();
//Récupération de l'extraction
            $datas = $sth->fetchALL(PDO::FETCH_ASSOC);
//Gestion du format de la date
            $intlDateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::NONE);
//Parcours et impression à l'écran des données
//Boucle pour parcourir toutes les lignes
            foreach($datas as $data){
                echo'<tr>';
                    echo '<td>' .strftime("%d-%m-%Y", strtotime($data['date_changement'])). '</td>';
                    echo '<td>' .$data['etage']. '</td>';
                    echo '<td>' .$data['position']. '</td>';
                    echo '<td>' .$data['puissance']. '</td>';
                    echo '<td>' .$data['marque']. '</td>';
                    echo '<td><a href="edit.php?edit=1&id='.$data['id'].'">Modifier</a></td>';
                    echo '<td><a href="delete.php?id='.$data['id'].'">Supprimer<a><td>';
                echo '</tr>';
            }
        ?>
    </table>
    <?php
//Si le nombre d'élément dans le tableau est nul
//Alors on enregistre pas
        if(count($datas)=== 0 ){
            echo"<p>Aucun changement d'ampoule</p>";
        }
    ?>
</div>
</body>
</html>