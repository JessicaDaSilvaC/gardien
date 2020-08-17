<link rel="stylesheet" href="style.css"/>
<?php
 session_start();
 $_SESSION = array();
 session_destroy();
 header('Location: index.php');
?>
