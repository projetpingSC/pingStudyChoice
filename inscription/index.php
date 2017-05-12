<?php
try{
   $bdd = new PDO('mysql:host=mysql2.paris1.alwaysdata.com;dbname=studychoice_utilisateurs', '136109', 'ping');
   echo'succes   ';
}
catch(Exception $e){
   echo'error  ';
}


if(isset($_SESSION['id']))
{
   header("Location: ../profil");
}


if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   $prof = htmlspecialchars($_POST['prof']);
   if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['prenom'])  AND !empty($_POST['prof'])) 
   {
      $nomlength = strlen($nom);
      $prenomlength = strlen($prenom);
      if($prenomlength <= 255)
      {
         if($nomlength <= 255) 
         {
            if ($prof != "professeur") {$prof = "eleve"; }
            if($mail == $mail2) {
               if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->query("SELECT * FROM users");
                    $result = $reqmail->fetch();
                    if ( $result == null)
                    {
                        //$this->remplir_BDD($mail, $bdd, $prenom, $nom, $mail, $mdp, $eleve);
                     $getid = $mailexist['id'];
                     if($mdp == $mdp2) {
                      $insertmbr = $bdd->prepare("INSERT INTO users(id, prenom, nom, mail, password, statut) VALUES(?, ?, ?, ?, ?, ?)");
                          $insertmbr->execute(array($getid+1, $prenom, $nom, $mail, $mdp, $prof));
                          unset($insertmbr);
                         $erreur = "Votre compte a bien été créé ! <a href=\"../connexion/\">Me connecter</a>";
                     }else {
                         $erreur = "Vos mots de passes ne correspondent pas !";
                     }
                     }else{ 
                       while ($mailexist = $result)
                       {
                        echo' mail existe            ';
                       if ($mail != $mailexist['mail'])
                       {
                           $getid = $mailexist['id'];
                           if($mdp == $mdp2) {
                               $insertmbr = $bdd->prepare("INSERT INTO users(id, prenom, nom, mail, password, statut) VALUES(?, ?, ?, ?, ?, ?)");
                               $insertmbr->execute(array($getid+1, $prenom, $nom, $mail, $mdp, $prof));
                               unset($insertmbr);
                               $erreur = "Votre compte a bien été créé ! <a href=\"../connexion/\">Me connecter</a>";
                           }else {
                               $erreur = "Vos mots de passes ne correspondent pas !";
                           }
                       }else{ 
                           $erreur = "adresse mail deja utilisée !"; 
                           break;
                       }
                           $result = $reqmail->fetch();
                       }
                     }

                } else {
                  $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
               $erreur = "Vos adresses mail ne correspondent pas !";
            }
         }else{ 
            $erreur = "Votre nom ne doit pas dépasser 255 caractères !";
         }
      } else {
         $erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<html>
   <head>
    <title>Study Choice</title>
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
    <link href="../css/agency.css" rel="stylesheet">
   </head>
   <body>

      <div align="center">
      <div class="col-lg-12">
        <div class="col-md-6">
         <h2>Inscription</h2>
         <br /><br />
         <form method="POST" action="">
            <table>
               <tr>
                  <td align="right">
                     <label for="prenom">Prenom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="nom">Nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Votre nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="statut">Prof ou élève ? :</label>
                  </td>
                  <td>
                  <select name="prof">
                     <option>professeur</option>
                     <option>élève</option>
                  </select>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Je m'inscris" />
                  </td>
               </tr>
            </table>
         </form>
         </div>
         </div>
         </div>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         if(isset($e))
         {
            echo'erreur';
         }
         ?>
      </div>
   </body>
</html>