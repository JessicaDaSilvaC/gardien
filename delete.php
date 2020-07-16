<?php
    require_once('db.php');

//Vérification de l'existence de la variable d'URL
    if(isset($_get['date_changement'])){

//Requête de suppression avec marqueyr lié avec une variable
        $sql = 'DELETE FROM gardien WHERE date_changement=:date_changement';

//Préparation de la requête
        $sth = $dbh->prepare($sql);

//lien entre marqueur et variable
        $sth->bindParam(':date_changement', $_GET[date_changement], PDO::PARAM_INT);

//Execution de la requête
        $sth->execute();
    }
//Redirection
    header('Location: index.php');
?>