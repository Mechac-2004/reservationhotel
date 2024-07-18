<?php
    session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        if(isset($_SESSION['email']) AND    !empty($_SESSION['email']))
        {
            if(isset($_POST['ajout']))
            {
                if(!isset($_POST['lib']) || empty($_POST['lib'])||!isset($_POST['ctyp']) || empty($_POST['ctyp']) ||
                !isset($_POST['prix']) || empty($_POST['prix']) || !isset($_POST['file']) || empty($_POST['file']) 
                || !isset($_POST['des']) || empty($_POST['des']) )
                {
                    $error="Remplissez tous les champs";
                }
                else
                {
                    $libel=htmlspecialchars($_POST['lib']);
                    $prix=htmlspecialchars($_POST['prix']);
                    $file=htmlspecialchars($_POST['file']);
                    $dess=htmlspecialchars($_POST['des']);
                    $cod=htmlspecialchars($_POST['ctyp']);
                    $req = $bdd->prepare('INSERT INTO chambre(libel_chamb, prix, imge, dess, num_typ) VALUES(?, ?, ?, ?, ? )');
                    $req->execute(array($libel, $prix, $file, $dess, $cod));
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Ajoutchambre.css">
    <title>Ajout Chambre</title>
</head>
<body>
    <section>
        <header>
            <div><p >AJOUT DE CHAMBRE</p></div>
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
                        <p class="got">Reservation</p>
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
                <p>Chambre</p>
            </div>
            <div class="form"> <center>
                <form action="#" method="POST">
                    <table> 
                    <p class="php">
                        <?php
                            if(isset($error))
                            {
                                echo $error;
                            }
                        ?>
                    </p>
                        <tr>
                            <td>Libelé Chambre:</td>
                            <td><input class="info" type="text" name="lib" id="" placeholder="Libelé"></td>
                        </tr>
                        <tr>
                            <td>Prix:</td>
                            <td><input class="info" type="text" name="prix" id="" placeholder="Prix"></td>
                        </tr>
                        <tr>
                            <td>Photo:</td>
                            <td><input class="info" type="file" name="file" id="" ></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input class="info" type="text" name="des" id="" ></td>
                        </tr>
                        <tr>
                            <td>Code Type:</td>
                            <td> <select class="info" name="ctyp" id="">
                                <option value="Chambre"> Chambre</option>
                            </select>
                            </td>
                        </tr>
                    </table>
                    <input class="bout" name="ajout" type="submit" value="Ajouter">
                </form>
            </center></div>
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
            header("Location:connect.php");
        }
    }
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    }
?>