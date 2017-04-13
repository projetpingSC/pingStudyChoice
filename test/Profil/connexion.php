<?php
session_start();
try{
  $bdd = mysqli_connect("127.0.0.1","root","","tes");
  echo'succes';
}
catch(Exception $e){
   echo'error';
}

class testTableData {

    function testTableData($bdd,$mailconnect,$mdpconnect){ 
        // testTable includes the columns: pseudo, id, mail
        $query = "SELECT * FROM test3";     
        $result = mysqli_query($bdd,$query) or die (mysqli_error());
        while ($row = mysqli_fetch_array($result))
        {
            foreach ($row as $var => $key) {
               $this->{$var} = $key;         
            }
            if($mailconnect == $this->mail && $mdpconnect != $this->password)
            {
               $erreur = "Mauvais mot de passe !";
            }else if ($mailconnect != $this->mail && $mdpconnect == $this->password){
               $erreur = "Mauvais mail !";
            }else if ($mailconnect == $this->mail && $mdpconnect == $this->password){
               break;
            }

         }   
    }

}
if(isset($_SESSION['id']))
{
   header("Location: profil.php?id=".$_SESSION['id']);
}else{
  if(isset($_POST['formconnexion'])) {
     $mailconnect = htmlspecialchars($_POST['mailconnect']);
     $mdpconnect = sha1($_POST['mdpconnect']);
     if(!empty($mailconnect) AND !empty($mdpconnect)) {

           $table = new testTableData($bdd,$mailconnect,$mdpconnect);

           if ($table->mail == $mailconnect && $table->password == $mdpconnect)
           {
              $_SESSION['id'] = $table->id;
              $_SESSION['pseudo'] = $table->pseudo;
              $_SESSION['mail'] = $table->mail;
              echo'connexion reussie';
              header("Location: profil.php?id=".$_SESSION['id']);

           } else {
              $erreur = "Mauvais mail ou mot de passe !";
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
     </head>
     <body>
        <div align="center">
           <h2>Connexion</h2>
           <br /><br />
           <form method="POST" action="">
              <input type="email" name="mailconnect" placeholder="Mail" />
              <input type="password" name="mdpconnect" placeholder="Mot de passe" />
              <br /><br />
              <input type="submit" name="formconnexion" value="Se connecter !" />
           </form>
           <?php
           if(isset($erreur)) {
              echo '<font color="red">'.$erreur."</font>";
           }
           ?>
        </div>
     </body>
  </html>
<?php }?>