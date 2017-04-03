<?php
include("connexion.php");
connexion();

$sql = 'SELECT * FROM users';

$req = mysql_query($sql) or die(mysql_error());


