<?php
 session_start();
 try
 {
    $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
    if(isset($_SESSION['email_cli']) AND    !empty($_SESSION['email_cli']))
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reservation</title>
    <link rel="stylesheet" href="servationss.css">
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

            <div class="li">
                <div class="stat1"> <p class="text1"><a class="text2" href="./voirchambre.php"> Réserver une Chambre</a> </p></div>
                <div class="stat1"><p class="text1"><a class="text2"  href="./voirsuite.php"> Réserver une Suite</a></p>
            </div>
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
