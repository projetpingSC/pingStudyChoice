<?php
session_start();
function mdp($mdp1,$mdp2) {
	try{
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=tes', 'root', ''); 
		echo'succes';
	}
	catch(Exception $e){
   	echo'error';
	}
    if($mdp == $mdp2) {
        $insertmbr = $bdd->prepare("UPDATE test SET motdepasse = ? WHERE id = ?");
        $insertmbr->execute(array($mdp,$_SESSION['id']));
        $erreur = "Votre mot de passe a bien été changé ! <a href=\"login.php\">Me connecter</a>";
    }else {
        $erreur = "Vos mots de passes ne correspondent pas !";
    }
}

?>