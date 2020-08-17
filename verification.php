
<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    $username = ($_POST['username']); 
    $password = ($_POST['password']);
    
    if($username == "Gardien" && $password == "Gardien_Ampoule")
    {
           $_SESSION['username'] = $username;
           header('Location: gestion.php');
    }
    else
    {
        $_SESSION['username'] = false;
       header('Location: index.php');
    }
}
else
{
   header('Location: index.php');
}
mysqli_close();
?>