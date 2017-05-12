<?php 
session_start();

header("Location: ../editer_profil/?id=".$_SESSION['id']); 

?>