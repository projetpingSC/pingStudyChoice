<?php
session_start();

//$bdd = mysqli_connect("mysql2.paris1.alwaysdata.com","136109","ping","studychoice_utilisateurs");
$bdd = mysqli_connect("localhost","root","","tes");

class testTableData {

    function testTableData($bdd,$mailconnect,$mdpconnect){ 
        // testTable includes the columns: pseudo, id, mail
        //$query = "SELECT * FROM users";     
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
   header("Location: ../profil/?id=".$_SESSION['id']);
}else{
  if(isset($_POST['formconnexion'])) {
     $mailconnect = htmlspecialchars($_POST['mailconnect']);
     $mdpconnect = sha1($_POST['mdpconnect']);
     if(!empty($mailconnect) AND !empty($mdpconnect)) {

           $table = new testTableData($bdd,$mailconnect,$mdpconnect);

           if ($table->mail == $mailconnect && $table->password == $mdpconnect)
           {
              $_SESSION['id'] = $table->id;
              $_SESSION['nom'] = $table->nom;
              $_SESSION['prenom'] = $table->prenom;
              $_SESSION['mail'] = $table->mail;
              $_SESSION['statut'] = $table->statut;
              $_SESSION['idprof'] = $table->idprof;
              $_SESSION['en_cours'] = $table->en_cours;
              if($_SESSION['idprof']) {
                header("Location: ../notation/?id=".$_SESSION['idprof']);
              } else { header("Location: ../profil/?id=".$_SESSION['id']); }
            
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inscrivez vous sur Studychoice et profitez au plus vite d&#39; un cours particuliers</title>

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
        <div align="text-center">
        <div class="col-lg-12">
        <div class="col-md-6">
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
        </div>
        </div>
     </body>
  </html>
<?php }?>