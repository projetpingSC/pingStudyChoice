<?php
session_start();
try{
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=tes', 'root', ''); 
	echo'succes';
}
catch(Exception $e){
   echo'error';
}

if($_SESSION['id'])
{
	if (isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		$request = "SELECT * FROM test3";
		$result = $bdd->query($request);
	    while ($row = $result->fetch())
	    {
	    	if($getid == $row['id'])
	        {
	        	$userinfo['nom'] = $row['nom'];
	        	$userinfo['id'] = $getid;
	        	$userinfo['mail'] = $row['mail'];
	        	$userinfo['prenom'] = $row['prenom'];
				$userinfo['statut'] = $row['statut'];
				$userinfo['disponible'] = $row['disponible'];

	        	break;
	        }
	    }
		if(isset($_POST['dispo'])) {
		    $insertmbr = $bdd->prepare("UPDATE test3 SET disponible = ? WHERE id = ?");
		    if ($userinfo['disponible'] == 0 or $userinfo['disponible'] == null) {$userinfo['disponible'] = 1;} else {$userinfo['disponible'] = 0;}

		    $insertmbr->execute(array($userinfo['disponible'],$_SESSION['id']));
		}

	}

	?>
	<html>
	<head>
		<title>Editer son Profil</title>
	</head>
	<body>
		<?php if ($userinfo['id'] == $_SESSION['id'])
		{
			?>changer de <input type="button" value="mot de passe" onclick="window.location.href='change_mdp.php';"/>  <?php //pas de href
			?>changer d'adresse <input type="button" value="mail" onclick="window.location.href='change_mail.php';"/><?php //pas de href
			?><form method="POST" action="">
				<input type="submit" name="dispo" value="changer de statut">
			</form>
			
			<a href="deconnexion.php">se deconnecter</a>
			<a href="editer_profil.php">editer mon profil</a><?php
		}

		?>

	</body>
	</html>
<?php }else{ header("Location: connexion.php");}?>
