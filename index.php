<?php 
    session_start();
    if ($_SESSION["username"] == false);
    {
        echo"<script>alert(\"l'identifiant ou le mot de passe est incorrect\")</script>";
    }
?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Gardien" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Gardien_Ampoule" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>