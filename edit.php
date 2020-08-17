<?php
    require_once('db.php');

//Vérification la reception du formulaire
    $date_changement = '';
    $etage = '';
    $position = '';
    $puissance = '';
    $marque = '';
    $error = false;

//Vérification mode "edit" et non mode "ajout"
    if(isset($_GET['id']) && isset($_GET['edit'])){
        $sql = 'SELECT id, date_changement, etage, position, puissance, marque FROM gardien where id = :id';
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $sth->execute();
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        if(gettype($data) === "boolean"){
//Redirection vers l'index
            header('location: index.php');
//Arrêt du script
            exit;
        }
        $id = $data['id'];
        $etage = $data['etage'];
        $position = $data['position'];
        $puissance = $data['puissance'];
        $marque = $data['marque'];
        $date_changement = $data['date_changement'];
    }

    if(count($_POST) >  0){
        if(strlen(trim($_POST['date'])) !==0){
            $date_changement = trim($_POST['date']);
        }else{
            $error = true;
        }
        if(strlen(trim($_POST['etage'])) !==0){
            $etage = trim($_POST['etage']);
        }else{
            $error = true;
        }
        if(strlen(trim($_POST['position'])) !==0){
            $position = trim($_POST['position']);
        }else{
            $error = true;
        }
        if(strlen(trim($_POST['puissance'])) !==0){
            $puissance = trim($_POST['puissance']);
        }else{
            $error = true;
        }
        if(strlen(trim($_POST['marque'])) !==0){
            $marque = trim($_POST['marque']);
        }else{
            $error = true;
        }
        //$complement = trim($_POST['complement']);
        if(isset($_POST['edit']) && isset($_POST['id'])){
            $id = htmlentities($_POST['id']);
        }
//Insertion dans la base de donnée, si aucune erreur
        if($error === false){
            if(isset($_POST['edit']) && isset($_POST['id'])){
//Mise à jour de la base de donnée
            $sql = 'UPDATE gardien SET date_changement=:date_changement, etage=:etage, position=:position, puissance=:puissance, marque=:marque WHERE id = :id';
            }else{
//Isertion des valeurs dans la base de donnée
                $sql = "INSERT INTO gardien(date_changement,etage,position,puissance,marque) VALUES(:date_changement,:etage,:position,:puissance,:marque)";
            } 
            var_dump($date_changement);
            $sth = $dbh->prepare($sql);
//Protèction de la database d'injetion sql
            $sth->bindValue(':date_changement',strftime("%Y-%m-%d", strtotime($date_changement)), PDO::PARAM_STR);
            $sth->bindParam(':etage',$etage, PDO::PARAM_STR);
            $sth->bindParam(':position',$position, PDO::PARAM_STR);
            $sth->bindParam(':puissance',$puissance, PDO::PARAM_STR);
            $sth->bindParam(':marque',$marque, PDO::PARAM_STR);
            if(isset($_POST['edit']) && isset($_POST['id'])){
                $sth->bindParam(':id',$id, PDO::PARAM_INT);
            }
            $sth->execute();
//Redirection après insertion
            header('Location: index.php');
        }
    }    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <?php 
        if(isset($_GET['id']) && isset($_GET['edit'])){
            echo'<title>Modifier des informations</title>';
        }else{
            echo"<title>Ajouter un changement d'ampoule</title>";
        }
    ?>
</head>
<body id="container">
    <?php
        if(isset($_GET['id']) && isset($_GET['edit'])){
            echo'<h1>Modifier des informations</h1>';
        }   else{
            echo"<h1>Ajouter un changement</h1>";
        }
    ?>
    <div>
        <form action="edit.php" method="post" class="cadre">
            <div>
                <input type="date" name="date" id="date" placeholder="date" value="<?php
                if($date_changement == ""){
                    echo strftime("%Y-%m-%d", strtotime("now"));
                } else {
                    echo strftime("%Y-%m-%d", strtotime($date_changement));
                }?>">
            </div>
            <div>
                <select name='etage' size='l'>
                    <option>Étage
                    <option <?php if($etage == 'Rez de chaussé') echo 'selected'; ?>>Rez de chaussé
                    <option <?php if($etage == '1er') echo 'selected'; ?>>1er
                    <option <?php if($etage == '2ème') echo 'selected'; ?>>2ème
                    <option <?php if($etage == '3ème') echo 'selected'; ?>>3ème
                    <option <?php if($etage == '4ème') echo 'selected'; ?>>4ème
                    <option <?php if($etage == '5ème') echo 'selected'; ?>>5ème
                    <option <?php if($etage == '6ème') echo 'selected'; ?>>6ème
                    <option <?php if($etage == '7ème') echo 'selected'; ?>>7ème
                    <option <?php if($etage == '8ème') echo 'selected'; ?>>8ème
                    <option <?php if($etage == '9ème') echo 'selected'; ?>>9ème
                    <option <?php if($etage == '10ème') echo 'selected'; ?>>10ème
                    <option <?php if($etage == '11ème') echo 'selected'; ?>>11ème
                </select>
            </div>
            <div>
                <select name='position' size='l'>
                    <option>Position
                    <option <?php if($position == 'Gauche') echo 'selected'; ?>>Gauche
                    <option <?php if($position == 'Droite') echo 'selected'; ?>>Droite
                    <option <?php if($position == 'Fond') echo 'selected'; ?>>Fond
                </select>
            </div>
            <div>
                <select name='puissance' size='l'>
                    <option>Puissance
                    <option <?php if($puissance == '25W') echo 'selected'; ?>>25W
                    <option <?php if($puissance == '50W') echo 'selected'; ?>>50W
                    <option <?php if($puissance == '60W') echo 'selected'; ?>>60W
                    <option <?php if($puissance == '75W') echo 'selected'; ?> >75W
                    <option <?php if($puissance == '100W') echo 'selected'; ?>>100W
                    <option <?php if($puissance == '150W') echo 'selected'; ?>>150W
                </select>
            </div>
            <div>
                <input type="text" name="marque" id="marque" placeholder="marque" value="<?= ($marque)?>">
            </div>
            
            <?php
                if(isset($_GET['id']) && isset($_GET['edit'])){
                    $texteButton = "Modifier";
                }else{
                    $texteButton = "Ajouter";
                }
            ?>
            <div>
                <button type="submit" class="modif"><?=$texteButton ?></button>
            </div>
            <?php 
                if(isset($_GET['id'])&& isset($_GET['edit'])){
            ?>
                    <input type="hidden" name="edit" value="1"/>
                    <input type="hidden" name="id" value="<?=$id ?>"/>

            <?php
                }
            ?>
        </form>
    </div>
</body>
</html>
