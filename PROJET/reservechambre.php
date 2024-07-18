<?php
session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        $reponse = $bdd->query('SELECT * FROM chambre WHERE num_typ="Chambre"');
        if(isset($_SESSION['email_cli']) AND    !empty($_SESSION['email_cli']))
        {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./reservechambre.css">
    <title> Réservation de Chambres</title>
</head>
<body>
        <div class="go">
                <nav class="nav">
                    <div>
                        <p><img class="img" src="./image/lg3.jpeg" alt=""></p> 
                    </div>
                    <div>
                        <a class="lien"  href="./acceuil.php"><p class="item">ACCEUIL</p> </a> 
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
    <div>
        <p class="hap">  CHAMBRES </p>
    </div>
    <hr>
 <div>
 <?php
        while ($donnees = $reponse->fetch())
        {?> 
    <div class="lot">
            <p ><?php echo  '<img class="lo" src="image/PHOTO/'. $donnees['imge'].' "/>'; ?></p>
            <p class="la">Description<br><?php echo $donnees['dess']?><br></p>
    </div>
    <p class="la">Nom: <?php echo $donnees['libel_chamb']?> <br>Prix: <?php echo $donnees['prix']?> FCFA </p>
    <a href="./reservationc.php"><input class="bouto" type="button" value="Réserver"></a>
    <?php } ?>
</div>
<hr>
<p class="j"><a class="voir" href="./voirchambre.php">Voir plus +</a></p>
    <hr>
    <footer>
            <div class="bas">
                <div class="ba">
                    <p class="ent">LIENS</p>
                    <div>
                        <a class="lien"   href="./acceuil1.php"><p class="ite"> ACCEUIL</p></a>  
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
                    <p class="ent">NOS PAGES</p>
                    <p> <a  class="toi" href="https://m.facebook.com/289076794468959/"><img class="ico" src="./image/f.png" alt=""> Facebook</p></a> 
                    <p> <a class="toi" href="https://instagram.com/novotelcotonouorisha?igshid=NTc4MTIwNjQ2YQ=="><img class="ico" src="./image/ins.png" alt=""> Instagram</a> </p>    
                </div>
                <div class="ba">
                    <p class="ent">LOCALISATION</p>
                    <p>Boulevard de la Marina, 08 BP 0929<br> 0 COTONOU, Bénin</p>
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