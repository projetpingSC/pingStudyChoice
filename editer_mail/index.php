<?php
session_start();


//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');

if($_SESSION['id'])
{
	if(isset($_POST['formmail'])) {
	   $mail = sha1($_POST['mail']);
	   $mail2 = sha1($_POST['mail2']);
	    if($mdp == $mdp2) {
	        //$insertmbr = $bdd->prepare("UPDATE users SET mail = ? WHERE id = ?");
	        $insertmbr = $bdd->prepare("UPDATE test3 SET mail = ? WHERE id = ?");
	        $insertmbr->execute(array($mdp,$_SESSION['mail']));
	        $erreur = "Votre adresse mail a bien été changée ! <a href=\"../connexion\">Me connecter</a>";
	    }else {
	        $erreur = "Vos adresses mail ne correspondent pas !";
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
		<?php if ($_GET['id'] == $_SESSION['id'])
		{
			
			?><form method="POST" action="">
				<table>
					<tr>
	                  <td align="right">
	                     <label for="mail">mail :</label>
	                  </td>
	                  <td>
	                     <input type="email" placeholder="Votre nouveau mail" id="mail" name="mail" />
	                  </td>
	               </tr>
	               <tr>
	                  <td align="right">
	                     <label for="mail2">Confirmation de l'email</label>
	                  </td>
	                  <td>
	                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" />
	                  </td>
	               </tr>
	               <tr>
	                  <td></td>
	                  <td align="center">
	                     <br />
	                     <input type="submit" name="formmail" value="changer !" />
	                  </td>
	               </tr>
				</table>
			</form>
			<?php
	        if(isset($erreur)) {
	           echo '<font color="red">'.$erreur."</font>";
	        }
	        if(isset($e))
	        {
	           echo'erreur';
	        }
	        ?> 


			<a href="../deconnexion">se deconnecter</a>
			<a href="../editer_profil">editer mon profil</a><?php
		}

		?>

	</body>
	</html>
<?php }else{header("Location: ../connexion");}?>