<?php
    require_once('db.php');

//Vérification de l'existence de la variable d'URL
    if(isset($_GET['id'])){

//Requête de suppression avec marqueyr lié avec une variable
        $sql = 'DELETE FROM gardien WHERE id=:id';

//Préparation de la requête
        $sth = $dbh->prepare($sql);

//lien entre marqueur et variable
        $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

//Execution de la requête
        $sth->execute();
    }
//Redirection
    header('Location: index.php');
?>