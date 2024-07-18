<?php
session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        $reponse = $bdd->query('SELECT * FROM administrateur');
        if(isset($_SESSION['email']) AND    !empty($_SESSION['email']))
        {

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./profil.css">
    <title>Profil</title>
</head>
<body>
    <section>
        <header>
            <div><p>PROFIL</p></div>
        </header>
     <div class="section">
        <aside>
            <div><a class="bro" href="../PROJET/acceuil.php"> NOVOTEL Cotonou</a></div>
            <div>
                <div><p ><a class="get" href="./tablebord.php">TABLEAU DE BORD</a></p></div>
                <ul>
                    <li>
                        <p class="got">Chambres</p>
                        <ul class="sous">
                            <li><a class="lien" href="./ajoutchambre.php">Ajouter</a></li>
                            <li><a class="lien" href="./listechambre.php">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="got">Suites</p>
                        <ul class="sous">
                            <li><a class="lien" href="./ajoutsuite.php">Ajouter</a></li>
                            <li><a class="lien" href="./listesuite.php">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="got">Reservations</p>
                        <ul class="sous">
                            <li><a class="lien" href="./ajoutreservation.php">Ajouter</a></li>
                            <li><a class="lien" href="./listereserve.php">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="got">Clients</p>
                        <ul class="sous">
                            <li><a class="lien" href="./listeclient.php">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="got">Administrateur</p>
                        <ul class="sous">
                            <li><a class="lien" href="./profil.php">Profil</a></li>
                            <li><a class="lien" href="./decon.php">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <article>
            <div>
                <div class="g">
                    <div class="l">
                        <div>
                            <?php
                                while ($donnees = $reponse->fetch())
                            {?>
                                <p class="tu">Profil: <?php echo $donnees['num_ad']?></p>
                                <p>Nom: <?php echo $donnees['nom_ad']?> </p>
                                <p>Prénom: <?php echo $donnees['pre_ad']?></p>
                                <p>E-Mail: <?php echo $donnees['email']?></p>
                                <a href="./modifier.php"><input class="bout" type="submit" value="Modifier"></a> 
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <a href="./ajoutad.php"><input class="bout" type="submit" value="Ajouter"></a> 
            </div> 
        </article>
     </div>
        <footer>
            <div><p>NOVOTEL Cotonou</p></div>
        </footer>
    </section>
</body>
</html>
<?php
        }
        else{
            header("Location:conn.php");

        }
    }
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    }
?>