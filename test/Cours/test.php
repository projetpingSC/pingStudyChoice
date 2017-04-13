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
  if(isset($POST['mdp']))
  {
    while($_POST['mdp']) { ?>
      
          <var name="password">
           <form method="POST" action="">
            <table>
                <tr>
                  <td align="right">
                    <label for="mdp1">Mot de passe :</label>
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
                  <td></td>
                  <td align="center">
                      <br />
                    <input type="submit" name="formpassword" value="changer !" />
                  </td>
                </tr>
            </table>
          </form>
         </var>
<?php }
    if(isset($_POST['formpassword'])) {
      $mdp = $_POST['mdp'];
      $mdp2 = $_POST['mdp2'];
        if($mdp == $mdp2) {
          $mdp =sha1($mdp);
          $insertmbr = $bdd->prepare("UPDATE test3 SET password = ? WHERE id = ?");
          $insertmbr->execute(array($mdp,$_SESSION['id']));
          $erreur = "Votre mot de passe a bien été changé ! <a href=\"login.php\">Me connecter</a>";
      }else {
          $erreur = "Vos mots de passes ne correspondent pas !";
      }
    }
  }


  ?>
  <html>
  <head>
      <title>Editer son Profil</title>
  </head>
  <body>
      <?php if ($_GET['id'] == $_SESSION['id'])
      {
         
         ?>changer de <form method="POST" action=""><input type="submit" name="mdp" value="mot de passe"></form>
         
         <?php
           if(isset($erreur)) {
              echo '<font color="red">'.$erreur."</font>";
           }
           if(isset($e))
           {
              echo'erreur';
           }
           ?> 


         <a href="../Profil/deconnexion.php">se deconnecter</a>
         <a href="editer_profil.php">editer mon profil</a><?php
      }

      ?>
   </body>
   </html>
<?php }else{ header("Location: ../Profil/connexion.php"); }?>