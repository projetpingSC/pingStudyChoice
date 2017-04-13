<?php 
session_start();

header("Location: editer_profil.php?id=".$_SESSION['id']); 

?>