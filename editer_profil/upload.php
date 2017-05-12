<?php
session_start();

//$bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
$bdd = new PDO('mysql:host=localhost;dbname=tes', 'root', '');

if(isset($_FILES['nom']))
{ 
    $dossier = '../images_de_profil/';
    $fichier = basename($_FILES['nom']['name']);
    $extension = pathinfo($fichier, PATHINFO_EXTENSION);
    if($extension == "PNG" || $extension == "JPG" || $extension == "JPEG" || $extension == "PDF"){
	    if(move_uploaded_file($_FILES['nom']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
	    {
	        $newname = "image_profil_".$_SESSION['id'].".".pathinfo($fichier,PATHINFO_EXTENSION);
		    rename($dossier.$fichier,$dossier.$newname);

		    $insertmbr = $bdd->prepare("UPDATE test3 SET nom_photo = ? WHERE id = ?");
			$insertmbr->execute(array($newname,$_SESSION['id']));
	    }
	    else //Sinon (la fonction renvoie FALSE).
	    {
	        $_SESSION['error'] =  "Echec de l'upload, veuillez recommencer";
    		header("Location: ../editer_profil/?id=".$_SESSION['id']);
	    }


    }else{
    	$_SESSION['error'] = "le format d'image ne correspond pas. Veuillez entrer une image au format PNG, JPG, PDF ou JPEG.";
    	header("Location: ../editer_profil/?id=".$_SESSION['id']);
    }

}

?>

