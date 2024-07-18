<?php
session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        if( isset($_SESSION['email_cli']) AND    !empty($_SESSION['email_cli']))
        {
            if(isset($_POST['comm']) )
            {
                if( !isset($_POST['sugg']) || empty($_POST['sugg']) || !isset($_POST['date']) || empty($_POST['date']) )
                {
                    $error="Remplissez tous les champs";
                }
                else
                {
                    $sugg=htmlspecialchars($_POST['sugg']);
                    $date=htmlspecialchars($_POST['date']);
                    $req = $bdd->prepare('INSERT INTO commentaire(sugg, dat_sugg) VALUES(?, ? )');
                    $q=$req->execute(array($sugg, $date ));
                }
            }
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Contacts.css">
    <title>Contacts</title>
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
    <hr>
        <center><form action="" method="POST" class="form" >
        <p class="entet">
            Votre avis
        </p>
    </div>
            <table>
            <p class="php" >
                <?php
                    if(isset($error))
                    {
                        echo $error;
                    }
                ?>
            </p>
            <tr>
                <td>Suggestion:</td>
                <td><input class="info" type="text" name="sugg" id=""></td>
            </tr>
                <tr>
                    <td>Date de visite:</td>
                    <td><input class="info" type="date" name="date" id=""></td>
                </tr>

            </table>
            <input class="bout" type="submit" name="comm" value="Commentez">
        </form></center>
    <hr>
    <div>
        <p class="ente">
            Contacter nous pour plus d'information
        </p>
    </div>
    <hr>
    <footer>
        <div class="bas">
            <div class="ba">
                <p class="ent">CONTACTS</p>
                <p  class="toi">Téléphone:+229 21 30 56 62</p>
                <p  class="toi">Fax:+229 21 30 41 88</p>
                <p  class="toi">mail:contacth1826-sl@accor.com</p>         
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
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    } 
?>