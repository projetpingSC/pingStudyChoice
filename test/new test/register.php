<?php

if (isset($_POST['submit']))
{
	$username = htmlentities(trim($_POST['username']));
	$password = htmlentities(trim($_POST['password']));
	$repeatpassword = htmlentities(trim($_POST['repeatpassword']));

	if($username&&$password&&$repeatpassword){
		if($password==$repeatpassword){

			$bdd = new PDO('mysql:host=127.0.0.1;dbname=testping','root','');

			$query = mysql_query("INSERT INTO users VALUES('','$username','$password')");
			die ("Inscription terminée <a href='login.php'>connectez-vous</a>");
		}else echo"les mdp ne correspondent pas";


	}else echo"veuillez saisir tous les champs";

}



?>



<form method="POST" action="register.php">
<input type="text" name="username">
<p>votre pseudo</p>
<input type="password" name="password">
<p> votre mdp</p>
<input type="password" name="repeatpassword"><br/><br/>
<input type="submit" value="s'inscrire">
</form>
