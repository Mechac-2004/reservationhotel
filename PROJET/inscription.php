<?php

    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        if(isset($_POST['inscrire']) )
        {
            if(!isset($_POST['nom']) || empty($_POST['nom']) || !isset($_POST['prenom']) || empty($_POST['prenom']) 
            ||!isset($_POST['sexe']) || empty($_POST['sexe']) ||!isset($_POST['telephone']) || empty($_POST['telephone'])||
            !isset($_POST['adresse']) || empty($_POST['adresse']) || !isset($_POST['email']) || empty($_POST['email'])||
            !isset($_POST['mots']) || empty($_POST['mots']) || !isset($_POST['motsd']) || empty($_POST['motsd'])   )
            {
                $error="Remplissez tous les champs";
            }
            else
            {
                $nom=htmlspecialchars($_POST['nom']);
                $prenom=htmlspecialchars($_POST['prenom']);
                $email=htmlspecialchars($_POST['email']);
                $telephone=htmlspecialchars($_POST['telephone']);
                $sexe=htmlspecialchars($_POST['sexe']);
                $adresse=htmlspecialchars($_POST['adresse']);
                $mots=htmlspecialchars($_POST['mots']);
                $motsd=htmlspecialchars($_POST['motsd']);
                $req1=$bdd->prepare('SELECT * FROM client WHERE email_cli=?');
                $req1->execute(array($email));
                $usersexist=$req1->rowcount();
                if ($usersexist==0)
                {
                    if($mots==$motsd)
                    {
                        $req = $bdd->prepare('INSERT INTO client(nom_cli, pre_cli,email_cli, tel_cli, sex_cli, adr_cli, mot_de_passe) 
                        VALUES(?, ?, ?, ?, ?, ?, ? )');
                        $q=$req->execute(array($nom, $prenom, $email, $telephone, $sexe, $adresse, $mots ));
                        header("Location:./connexion.php");
                    }
                    else
                    {
                        $err="Les mots de passe ne correspondent pas";
                    }
                }else
                {
                    $err="Cet email est déjà utilisé";
                }
            }
        }
    }
    catch ( exception $e )
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
    <title>Inscription</title>
    <link rel="stylesheet" href="Inscription.css">
</head>
<body>

 <div class="foi"> 
    <div class="ess">
        <div class="ente">
            <p>INSCRIVEZ VOUS ICI</p>
        </div>
        <div class="form"><center>
            <form action="" method="POST">
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
                        <td>Nom:</td>
                        <td> <input class="info" type="text" name="nom" placeholder="Nom"> </td>
                    </tr>
                    <tr>
                        <td>Prénom:</td>
                        <td> <input class="info" type="text" name="prenom" placeholder="Prénom"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td> <input class="info" type="email" name="email" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <td>Téléphone:</td>
                        <td> <input class="info" type="text" name="telephone" placeholder="Téléphone"></td>
                    </tr>
                    <tr>
                        <td>Sexe:</td>
                        <td> 
                            <select  class="info" name="sexe" id="">
                                <option value=""></option>
                                <option value="M">Masculin</option>
                                <option value="F">Féminin</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Adresse:</td>
                        <td> <input class="info"  type="text" name="adresse" placeholder="Adresse"></td>
                    </tr>
                    <p class="php" >
                        <?php
                            if(isset($err))
                            {
                                echo $err;
                            }
                        ?>
                    </p>
                    <tr>
                        <td>Mot de passe:</td>
                        <td> <input class="info"   type="password" name="mots" placeholder="Mot de passe" maxlength="10"></td>
                    </tr>
                    <tr>
                        <td>Confirmation:</td>
                        <td> <input class="info"   type="password" name="motsd" placeholder="Confirmation" maxlength="10"></td>
                    </tr>
                </table><br>
                <input class="bout"  type="submit" name="inscrire" value="S'insrire"><br>  <br>
            </form>
            <p class="toi"><a class="toi" href="./connexion.php"> Se connecter</a></p> 
        </center></div>
    </div>
 </div>  

</body>
</html>
<?php


?>