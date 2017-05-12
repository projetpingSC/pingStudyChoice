<?php
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');


if($_SESSION['id'])
{
	if (isset($_GET['id']) AND $_GET['id'] > 0 AND $_GET['id'] == $_SESSION['id'])
	{
		if (isset($_SESSION['idprof'])) { header("Location: ../notation/?id=".$_SESSION['idprof']); }
		$getid = intval($_GET['id']);
		//$request = $bdd->prepare("SELECT * FROM users");
		$request = $bdd->prepare("SELECT * FROM test3");
		$request->execute(array());
	    while ($row = $request->fetch())
	    {
	    	if($getid == $row['id'])
	        {
	        	$userinfo['eleve'] = $row['eleveId'];
	        	$userinfo['prenom'] = $row['prenom'];
	        	$userinfo['nom'] = $row['nom'];
	        	$userinfo['id'] = $getid;
	        	$userinfo['mail'] = $row['mail'];
	        	$userinfo['photo'] = $row['nom_photo'];
	        	$userinfo['phone'] = $row['telephone'];
	        	$userinfo['adresse'] = $row['adresse'];
	        	break;
	        }
	    }
	    unset($request);
	    ?><div align="center">
			<h2>Profil de <?php echo $userinfo['prenom']."     ".$userinfo['nom']; ?></h2><br/>
			mail : <?php echo $userinfo['mail']; ?> <br/> 

			<?php if ($userinfo['phone']) {
				echo "telephone : ".$userinfo['phone']."<br/>"; }

			if (isset($userinfo['photo'])) {  ?>
			<img src=<?php echo "../images_de_profil/".$userinfo['photo']; ?> class="petite_image" alt=""> <?php } // on met la photo en commentaire pour ne pas encombrerla page
			?>





		</div>
		<div><?php
		if($userinfo['eleve']) {
			echo 'Un eleve veut prendre un cours avec vous';
			$_SESSION['eleveid'] = $userinfo['eleve'];
			?><form method="POST" action="accepter.php">
				<input type="submit" name="accepter" value="accepter">
			</form><?php
			// if accepter alors notification pour les 2 + chat qui s'ouvre


		}

		?></div><?php
	} else if ( isset($_GET['id']) AND $_GET['id'] > 0 AND $_GET['id'] != $_SESSION['id'] ) {
		$getid = intval($_GET['id']);
		//$request = $bdd->prepare("SELECT * FROM users");
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
	        	$userinfo['photo'] = $row['nom_photo'];
	        	$userinfo['phone'] = $row['telephone'];
	        	$userinfo['adresse'] = $row['adresse'];
	        	break;
	        }
	    }
	    unset($request);
		?><var>Vous etes sur le profil de <?php echo $userinfo['prenom']."  ".$userinfo['nom'];

			if (isset($userinfo['phone'])) {
			echo "telephone : ".$userinfo['phone']; }

			if (isset($userinfo['photo'])) {  ?>
			<img src=<?php echo "../images_de_profil/".$userinfo['photo']; ?> class="petite_image" alt=""> <?php } // on met la photo en commentaire pour ne pas encombrerla page
			?>
		</var>
			Voulez-vous avoir un cours avec cette personne ? 
			<form method="POST" action=""><input type="submit" name="cours" value="demander un cours"> </form>
	<?php
		if (isset($_POST['cours']))
		{

			//$update = $bdd->prepare("UPDATE users SET idprof = ? WHERE id = ?");
			$update = $bdd->prepare("UPDATE test3 SET idprof = ? WHERE id = ?");
			$update->execute(array((int)$_GET['id'],(int)$_SESSION['id']));
			unset($update);
			$update = $bdd->prepare("UPDATE test3 SET eleveid = ? WHERE id = ?");
			$update->execute(array((int)$_SESSION['id'],(int)$_GET['id']));
			unset($update);
			$_SESSION['idprof'] = $_GET['id'];

		}

	} else { header("Location: ../connexion"); }
} else{ header("Location: ../connexion"); } ?>

	<html>
	<head>
		<title>Sudy Choice</title>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	     <!-- Bootstrap Core CSS -->
	    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom Fonts -->
	    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
	    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	    <!-- Theme CSS -->
	    <link href="../css/agency.min.css" rel="stylesheet">
	</head>
	<body>

		<div align="center">
			<?php if ($userinfo['id'] == $_SESSION['id'])
			{
				?><a href="../deconnexion">se deconnecter</a>
				<a href="redirect_edition_profil.php">editer mon profil</a>
				<a href="../demander_un_cours/">Rechercher un cours</a>
				<?php
			}

			?>
		</div>
	</body>
	</html>