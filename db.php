
<?php
    define('DATABASE', 'gardien');
    define('USER', 'root');
    define('PWD','');
    define('HOST','localhost');
        try{
                $dbh = new PDO('mysql:host='.HOST.';port=3308;dbname='.DATABASE.'', USER, PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
        } catch (PDOException $e){
            print "Erreur !:" .$e->getMessage(). "<br>";
            die();
        }
?>
