<?php
session_start();
try{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=tes', 'root', ''); 
	echo'succes';
}
catch(Exception $e){
   echo'error';
}

if ($_SESSION['id'])
{
	$getid = (int) $_SESSION['id'];

	if(isset($_POST['desinscire']))
		{
			$break = $bdd->prepare("DELETE FROM test3 WHERE id = ?");
			$break->execute(array($getid));
			$_SESSION = array();
			session_destroy();
			header("Location: desinscrit.php");
		}



	?>
<!DOCTYPE html>
<html>
<head>
	<title>Study Choice</title>
</head>
<body>
	<var align="center">Voulez-vous vous désinscrire ?</var>
	<form method="POST" action="">
		<input type="submit" name="desinscire" value="Je veux me désinscire">
	</form>

</body>
</html>
<?php } else { header("Location: inscription.php"); }