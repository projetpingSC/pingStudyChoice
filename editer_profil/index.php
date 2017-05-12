<?php
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');

if($_SESSION['id'])
{
	if (isset($_GET['id']) AND $_GET['id'] > 0)
	{
		$getid = intval($_GET['id']);
		//$request = "SELECT * FROM users";
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
		    //$insertmbr = $bdd->prepare("UPDATE users SET disponible = ? WHERE id = ?");
		    $insertmbr = $bdd->prepare("UPDATE test3 SET disponible = ? WHERE id = ?");
		    if ($userinfo['disponible'] == 0 or $userinfo['disponible'] == null) {$userinfo['disponible'] = 1;} else {$userinfo['disponible'] = 0;}

		    $insertmbr->execute(array($userinfo['disponible'],$_SESSION['id']));
		}

		if (isset($_POST['telephone'])) {
			$phone = htmlspecialchars($_POST['telephone']);
			if(strlen($phone) == 10){
				if($phone[0] == "0" && ($phone[1] == "6" || $phone[1] == "7")) {
					//$insertmbr = $bdd->prepare("UPDATE users SET disponible = ? WHERE id = ?");
				    $insertmbr = $bdd->prepare("UPDATE test3 SET telephone = ? WHERE id = ?");
				    $insertmbr->execute(array($phone,$_SESSION['id']));
				} else {$error_phone = "votre numero de telephone ne commence pas par 06 ou 07"; }

			} else { $error_phone = "Votre numero de telphone ne comprend pas 10 chiffres"; }
		}

		if (isset($_POST['address'])) {
			if ($_POST['adresse'] != null && $_POST['ville'] != null && $_POST['postal'] != null) {
				$adresse = htmlspecialchars($_POST['adresse']);
				$postal = htmlspecialchars($_POST['postal']);
				$ville = htmlspecialchars($_POST['ville']);
				//$insertmbr = $bdd->prepare("UPDATE users SET ville = ? AND adresse = ? AND code_postal = ? WHERE id = ?");
				$insertmbr = $bdd->prepare("UPDATE test3 SET ville = ? AND adresse = ? AND code_postal = ? WHERE id = ?");
				$insertmbr->execute(array($ville,$adresse,$postal,$_SESSION['id']));
			}else { $error_address = "Veuillez remplir tous les champs"; }
		} 


	}

	?>
	<html>
	<head>
		<title>Editer son Profil</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	</head>

	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="../css/agency.min.css" rel="stylesheet">
	<body>
		<?php if ($userinfo['id'] == $_SESSION['id'])
		{
			?>changer de <input type="button" value="mot de passe" onclick="window.location.href='change_mdp.php';"/>  <?php //pas de href
			?>changer d'adresse <input type="button" value="mail" onclick="window.location.href='change_mail.php';"/><?php //pas de href
			?>matiere <input type="button" value="matiere" onclick="window.location.href='../edition_matieres/';"/><?php //pas de href
			?><form method="POST" action="">
				<input type="submit" name="dispo" value="changer de statut">
			</form>
			<form method="POST" action="upload.php" enctype="multipart/form-data">
				Fichier : <input type="file" name="nom" />
				<input type="submit" name="image" value="envoyer">
				<?php
				if (isset($_SESSION['error'])) {
					echo '<font color="red">'.$_SESSION['error']."</font>";
					$_SESSION['error'] = null;
				}
				?>
			</form>
			<form method="POST" action="">

				telephone : <input type="text" name="telephone" placeholder="Votre numero de telephone" id="telephone">
				<input type="submit" name="phone"><?php 
				if(isset($error_phone)){
					echo '<font color="red">'.$error_phone."</font>";
				}
				?>
			</form>
			<form method="POST" action="">
			<table>
				<tr>
					<td>
						adresse :
					</td>
					<td>
						<input type="test" name="adresse" placeholder="votre adresse" id="adresse">
					</td>
				</tr>
				<tr>
					</td>
					<td>
						code postal : 
					</td>
					<td>
						<input type="text" name="postal" placeholder="code postal" id="postal"> 
					</td>
				</tr>
					<td>
						Ville :
					</td>
					<td>
						<input type="text" name="ville" placeholder="ville" id="ville">
					</td>
				</tr>
			</table>
				<input type="submit" name="address" id="address">
				<?php if(isset($error_address)){
					echo '<font color="red">'.$error_address."</font>"; }?>
			</form>
			
			
			<a href="../deconnexion">se deconnecter</a>
			<a href=<?php echo "../editer_profil\?id=".$_SESSION['id']?>>editer mon profil</a>
			<a href="../description">se désinscrire</a><?php
		}

		?>

	</body>
	</html>
<?php }else{ header("Location: ../connexion");}?>
