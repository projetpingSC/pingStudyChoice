<?php
session_start();
header("Location: changer_de_mot_de_passe.php?id=".$_SESSION['id']);

?>