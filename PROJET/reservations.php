<?php
    session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        $reponse = $bdd->query('SELECT * FROM client');
        $repons = $bdd->query('SELECT * FROM chambre WHERE num_typ="Suite"');
        if(isset($_SESSION['email_cli']) AND    !empty($_SESSION['email_cli']))
        {
            if(isset($_POST["reserver"] )  )
            {
                if(!isset($_POST['nom']) || empty ($_POST['nom']) || !isset($_POST['datd']) || empty ($_POST['datd']) ||
                 !isset($_POST['datf']) || empty ($_POST['datf']) || !isset($_POST['sel']) || empty ($_POST['sel']) || !isset($_POST['email']) || empty ($_POST['email'])   )
                {
                    $error="Remplissez tous les champs";
                }
                else
                {
                    $sugg=htmlspecialchars($_POST['nom']);
                    $email=htmlspecialchars($_POST['email']);
                    $dat=htmlspecialchars($_POST['datd']);
                    $date=htmlspecialchars($_POST['datf']);
                    $da=htmlspecialchars($_POST['sel']);
                    $req1=$bdd->prepare('SELECT * FROM client WHERE email_cli=?');
                    $req1->execute(array($email));
                    $usersexist=$req1->rowcount();
                    if($usersexist==1)
                    {   
                        $donne=$req1->fetch();
                        $req= $bdd->prepare('INSERT INTO reservation(libel_reserv, email, dat_debut, dat_fin, nom_chamb, num_cli) VALUES(?, ?, ?, ?, ?, ? )');
                        $req->execute(array($sugg, $email, $dat, $date, $da, $donne['num_cli'] )); 
                    }
                    else 
                    {
                        $err ="Email inexistant";
                    }

                }  
            }
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation</title>
    <link rel="stylesheet" href="Reservation.css">
</head>
<body>
    <div class="go">
            <nav class="nav">
                    <div>
                       <p><img class="img" src="./image/lg3.jpeg" alt=""></p> 
                    </div>
                    <div>
                      <a class="lien"  href="./acceuil1.php"><p class="item">ACCEUIL</p> </a> 
                    </div>
                    <div>
                       <a class="lien"  href="./chambre.php"><p class="item">Nos Chambres </p> </a> 
                    </div>
                    <div>
                       <a class="lien"  href="./reservation.php"><p class="item">RESERVATIONS</p> </a> 
                    </div>
                    <div>
                       <a class="lien"  href="./contacts.php"><p class="item">CONTACTS</p> </a> 
                    </div>
                </nav>
    </div>
    <div class="vian">
    <div class="ess">
        <p class="ente">RESERVATIONS</p>
      <center>
        <form  action="" method="POST">
            <table>
            <p class="php" >
                <?php
                    if(isset($error) )
                    {
                        echo $error; 
                    }
                    if(isset($err) )
                    {
                        echo $err;
                    }

                ?>
            </p>
                <tr>
                    <td><label for="nom">Libelé séjour:</label></td>
                    <td><input class="info" type="text" name="nom" placeholder="Libelé"></td>
                </tr>
                <tr>
                    <td><label for="nombre">Email:</label></td>
                    <td><input class="info" type="email" name="email" id=""></td>
                </tr>
                <tr>
                    <td><label for="nombre">Date de début:</label></td>
                    <td><input class="info" type="date" name="datd" id=""></td>
                </tr>
                <tr>
                    <td><label for="nombre">Date de Fin:</label></td>
                    <td><input class="info" type="date" name="datf" id=""></td>
                </tr>
                <tr>
                    <td><label for="nombre">Chambre:</label></td>
                    <td>
                        <select class="info" name="sel" id="">
                        <?php
                            while ($donnees = $repons->fetch())
                        {?> 
                            <option value="<?php echo $donnees['libel_chamb']; ?>"><?php echo $donnees['libel_chamb']; ?></option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input class="bout" name="reserver" type="submit" value="Réserver"><br>  <br>
        </form>
    </center>
    </div>
</div>
    <hr>
    <footer>
            <div class="bas">
                <div class="ba">
                    <p class="ent">LIENS</p>
                    <div>
                        <a class="lien"   href="./acceuil.php"><p class="ite"> ACCEUIL</p></a>  
                    </div> 
                    <div>
                        <a class="lien"  href="./chambre.php"><p class="ite">Nos Chambres </p> </a> 
                   </div>
                   <div>
                     <a class="lien"  href="./inscription.php"><p class="ite">INSCRIPTION</p></a>  
                    </div>
                    <div>
                        <a class="lien"  href="./reservation.php"><p class="ite">RESERVATIONS</p> </a> 
                    </div>
                    <div>
                        <a class="lien"  href="./contacts.php"><p class="ite">CONTACTS</p> </a> 
                    </div>
                </div>
                <div class="ba">
                    <p class="ent"> NOS PAGES</p>
                    <p> <a  class="toi" href="https://m.facebook.com/289076794468959/"><img class="ico" src="./image/f.png" alt=""> Facebook</p></a> 
                    <p> <a class="toi" href="https://instagram.com/novotelcotonouorisha?igshid=NTc4MTIwNjQ2YQ=="><img class="ico" src="./image/ins.png" alt=""> Instagram</a> </p>
                </div>
                <div class="ba">
                    <p class="ent">LOCALISATION</p>
                    <p class="toi">Boulevard de la Marina, 08 BP 0929<br> 0 COTONOU, Bénin</p>
                    <img  src="./image/local.png" alt="" height="150px" width="500px">
                </div>
    
            </div>
        </footer>
</body>
</html>
<?php
    }
    else
    {
        header("Location:./connexion.php");
    }
 }
 catch ( exception $e)
   {
      die ('Erreur de lecture'.$e->getmessage());
   }
?>