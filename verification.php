<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = "Gardien"; 
    $password = "Gardien_Ampoule";

    $username = mysqli_real_escape_string(htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string(htmlspecialchars($_POST['password']));
    
    if($username === "Gardien" && $password === "Gardien_Ampoule")
    {
        $requete = "SELECT count(*) FROM utilisateur where 
              nom_utilisateur = ''Gardien'".$username."' and mot_de_passe = ''Gardien_Ampoule'".$password." '";
        $exec_requete = mysqli_query($requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['username'] = $username;
           header('Location: gestion.php');
        }
        else
        {
           header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: index.php');
}
mysqli_close(); // fermer la connexion
?>