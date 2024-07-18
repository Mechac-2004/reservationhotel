<?php
session_start();
   try
   {
      $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
      if(isset($_POST['conn']))
      {
         if(!isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['password']) || empty($_POST['password']) )
         {
            $error="Remplissez tous les champs";
         }
         else
         {
            $email=htmlspecialchars($_POST['email']);
            $password=htmlspecialchars($_POST['password']);
            $req=$bdd->prepare('SELECT * FROM client WHERE email_cli=? AND mot_de_passe=?');
            $req->execute(array($email, $password));
            $usersexist=$req->rowcount();
            if($usersexist==1)
            {
               $userinfos=$req->fetch();
               $_SESSION['email_cli']=$userinfos['email_cli'];
               $_SESSION['mot_de_passe']=$userinfos['mot_de_passe'];
               header("Location: acceuil1.php?email_cli=".$_SESSION['email_cli']);
            }else
            {
               $error="Email ou Mot de passe incorrect:";
            }
         }
      }
   }
   catch ( exception $e)
   {
      die ('Erreur de lecture'.$e->getmessage());
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./connexion.css">
    <title>CONNEXION</title>
</head>
<body>

   <div class="moi">
    <div class="uni">
            <form action="" method="POST"><center>
               <p class="php">
                  <?php
                     if(isset($error))
                    {
                      echo $error;
                    }
                  ?>
               </p>
                    <input class="info" type="email" name="email" id="" placeholder="Mail"> <br><br>
                    <input class="info" type="password" name="password" id="" placeholder="Mot de passe"> <br><br>
                    <input class="bout" type="submit" name="conn" value="Se Connecter"><br>
                    <p class="toi"> <a class="toi" href="./inscription.php">Créez un compte </a> </p>
            </center></form>
    </div>
   </div>
</body>
</html>