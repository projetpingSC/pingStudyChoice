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
	if (isset($_GET['id']) AND $_GET['id'] > 0 AND $_GET['id'] == $_SESSION['id'])
	{
		$getid = intval($_GET['id']);
		$request = $bdd->prepare("SELECT * FROM test3");
		$request->execute(array());
	    while ($row = $request->fetch())
	    {
	    	if($getid == $row['id'])
	        {
	        	$userinfo['prenom'] = $row['prenom'];
	        	$userinfo['nom'] = $row['nom'];
	        	$userinfo['id'] = $getid;
	        	$userinfo['mail'] = $row['mail'];
	        	break;
	        }
	    }
	    unset($request);
	    ?><div align="center">
			<h2>Profil de <?php echo $userinfo['prenom']."     ".$userinfo['nom']; ?></h2><br/>
			mail : <?php echo $userinfo['mail']; ?><br/>
		</div><?php
	} else {
		$getid = intval($_GET['id']);
		$request = $bdd->prepare("SELECT * FROM test3");
		$request->execute(array());

	    while ($row = $request->fetch())
	    {
	    	if($getid == $row['id'])
	        {
	        	$userinfo['prenom'] = $row['prenom'];
	        	$userinfo['nom'] = $row['nom'];
	        	$userinfo['id'] = $getid;
	        	$userinfo['mail'] = $row['mail'];
	        	break;
	        }
	    }
	    unset($request);
		?><var>Vous etes sur le profil de <?php echo $userinfo['prenom']."  ".$userinfo['nom'];?></var>
			Voulez-vous avoir un cours avec cette personne ? 
			<form method="POST" action=""><input type="submit" name="cours" value="demander un cours"> </form>
	<?php
		if (isset($_POST['cours']))
		{
			$update = $bdd->prepare("UPDATE test3 SET idprof = ? WHERE id = ?");
			$update->execute(array($_GET['id'],$_SESSION['id']))
		}

	}
	?>

	<html>
	<head>
		<title>Sudy Choice</title>
		<meta charset="utf-8">
	</head>
	<body>

		<div align="center">
			<?php if ($userinfo['id'] == $_SESSION['id'])
			{
				?><a href="deconnexion.php">se deconnecter</a>
				<a href="redirect_edition_profil.php">editer mon profil</a>
				<a href="../Cours/recherche_cours.php">Rechercher un cours</a>
				<?php
			}

			?>
		</div>
	</body>
	</html>
<?php 
}else{ header("Location: connexion.php"); } ?>