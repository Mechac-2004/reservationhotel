<?php
    session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        $repons = $bdd->query('SELECT * FROM chambre');
        if(isset($_SESSION['email']) AND    !empty($_SESSION['email']))
        {
            if(isset($_POST['ajout']))
            {
                if(!isset($_POST['lib']) || empty($_POST['lib']) || !isset($_POST['datd']) || empty($_POST['datd']) || !isset($_POST['datf']) || empty($_POST['datf'])
                || !isset($_POST['sel']) || empty ($_POST['sel']) )
                {
                    $error="Remplissez tous les champs";
                }
                else
                {
                    $libel=htmlspecialchars($_POST['lib']);
                    $datd=htmlspecialchars($_POST['datd']);
                    $datf=htmlspecialchars($_POST['datf']);
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
    <link rel="stylesheet" href="./ajoutreservation.css">
    <title>Ajout Réservation</title>
</head>
<body>
    <section>
        <header>
            <div><p >AJOUT DE RESERVATION</p></div>
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
                            <li><a class="lien" href="./listechambre.hphp">Liste</a></li>
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
                <div class="mot">
                        <p>Réservation</p>
                    </div>
                    <div class="form">
                        <form action="" method="POST">
                            <table> 
                            <center><p class="php">
                                <?php
                                    if(isset($error))
                                    {
                                        echo $error;
                                    }
                                ?>
                            </p></center>
                                <tr>
                                    <td>Libelé:</td>
                                    <td><input class="info" type="text" name="lib" id="" placeholder="Libelé"></td>
                                </tr>
                                <tr>
                    <td><label for="nombre">Email:</label></td>
                    <td><input class="info" type="email" name="email" id="" placeholder="Email du client"></td>
                </tr>
                                <tr>
                                    <td>Date Début:</td>
                                    <td><input class="info" type="date" name="datd" id="" placeholder="Début"></td>
                                </tr>
                                <tr>
                                    <td>Date Fin:</td>
                                    <td><input class="info" type="date" name="datf" id="" placeholder="Fin"></td>
                                </tr>
                                <tr>
                    <td><label for="nombre">Chambre:</label></td>
                    <td>
                        <select class="info" name="sel" id="">
                        <?php
                            while ($donnees = $repons->fetch())
                        {?> 
                            <option value="Suite"><?php echo $donnees['libel_chamb']; ?></option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>
                            </table>
                            <input class="bout" name="ajout" type="submit" value="Ajouter">
                        </form>
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
        else
        {
            header("Location:conn.php");
        }
    }
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    }
?>