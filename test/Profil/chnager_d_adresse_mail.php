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
	if(isset($_POST['formmail'])) {
	   $mail = sha1($_POST['mail']);
	   $mail2 = sha1($_POST['mail2']);
	    if($mdp == $mdp2) {
	        $insertmbr = $bdd->prepare("UPDATE test3 SET mail = ? WHERE id = ?");
	        $insertmbr->execute(array($mdp,$_SESSION['mail']));
	        $erreur = "Votre adresse mail a bien été changée ! <a href=\"editer_profil.php\">Me connecter</a>";
	    }else {
	        $erreur = "Vos adresses mail ne correspondent pas !";
	    }
	}

	?>
	<html>
	<head>
		<title>Study Choice</title>
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


			<a href="deconnexion.php">se deconnecter</a>
			<a href="editer_profil.php">editer mon profil</a><?php
		}

		?>

	</body>
	</html>
<?php }else{header("Location: connexion.php");}?>