<?php
    session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        if(isset($_SESSION['email']) AND    !empty($_SESSION['email']))
        {
            if(isset($_POST['ajout']))
            {
                if(!isset($_POST['nom']) || empty($_POST['nom']) || !isset($_POST['prenom']) || empty($_POST['prenom'])||
                !isset($_POST['email']) || empty($_POST['email']) || !isset($_POST['mots']) || empty($_POST['mots']) ||
                !isset($_POST['motsd']) || empty($_POST['motsd']) ) 
                {
                    $error="Remplissez tous les champs";
                }
                else
                {
                    $nom=htmlspecialchars($_POST['nom']);
                    $prenom=htmlspecialchars($_POST['prenom']);
                    $email=htmlspecialchars($_POST['email']);
                    $mots=htmlspecialchars($_POST['mots']);
                    $motsd=htmlspecialchars($_POST['motsd']);
                    if ($email==1)
                    {
                        if($mots==$motsd)
                        {
                            $req = $bdd->prepare('INSERT INTO administrateur(nom_ad, pre_ad, email, loginword) 
                                VALUES(?, ?, ?, ? )');
                            $req->execute(array($nom, $prenom, $email, $mots ));
                            header("Location:./profil.php"); 
                        }else
                        {
                            $err="Les mots de passe ne correspondent pas";
                        }
                    }else
                    {
                        $err="Cet email est déjà utilisé";
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
    <link rel="stylesheet" href="./ajoutad.css">
    <title>Ajout Administrateur</title>
</head>
<body>
    <section>
        <header>
            <div><p>Administrateur</p></div>
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
            <div> <center>
                <div>
                    <p class="ente">Ajouter</p>
                </div>
                <form class="form" action="" method="POST">
                    <table>
                    <p class="php">
                        <?php
                            if(isset($error))
                            {
                                echo $error;
                            }
                            if(isset($err))
                            {
                                echo $err;
                            }
                        ?>
                    </p>
                        <tr>
                            <td>Nom:</td>
                            <td><input class="info" type="text" name="nom" id="" placeholder="Nom"></td>
                        </tr>
                        <tr>
                            <td>Prénom:</td>
                            <td><input class="info" type="text" name="prenom" id="" placeholder="Prénom"></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td><input class="info" type="text" name="email" id="" placeholder="E-mail"></td>
                        </tr>
                        <tr>
                            <td>PassWord:</td>
                            <td><input class="info" type="password" name="mots" id="" placeholder="PassWord"></td>
                        </tr>
                        <tr>
                            <td>Confirm:</td>
                            <td><input class="info" type="password" name="motsd" id="mots" placeholder="Confirm"></td>
                        </tr>
                    </table>
                    <input class="bout" type="submit" name="ajout" value="Ajouter">
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
    header("Location:conn.php");

}
}
catch ( exception $e)
{
die ('Erreur de lecture'.$e->getmessage());
}

?>