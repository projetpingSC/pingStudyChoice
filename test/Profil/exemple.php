<?php
session_start();
try{
$bdd = new PDO('mysql:host=127.0.0.1;dbname=tes', 'root', '');
echo'succes';
}
catch(Exception $e){
   echo'error';
}

if (isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET);
    $request = 'SELECT * FROM test WHERE id = ?';
    $requser = $bdd->prepare($request);
    $userinfo = $bdd->execute($getid);
}
?>

<html>
<head>
    <title>Sudy Choice</title>
    <meta charset="utf-8">
</head>
<body>
    <div align="center">
        <h2>Profil de ...</h2>
        pseudo : <?php echo $userinfo['pseudo']; ?><br/>
        mail : <?php echo $userinfo['mail']; ?>
    
    </div>
</body>
</html>