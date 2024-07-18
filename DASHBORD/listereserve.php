<?php
session_start();
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
        $reponse = $bdd->query('SELECT * FROM reservation');
        if(isset($_SESSION['email']) AND    !empty($_SESSION['email']))
        {


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./Listereserve.css">
    <title>Liste des Réservations</title>
</head>
<body>
    <section>
        <header>
            <div><p>LISTE DES RESERVATION</p></div>
        </header>
     <div class="section">
        <aside>
            <div><a class="bro" href="../PROJET/acceuil.php"> NOVOTEL Cotonou</a></div>
            <div>
                <div><p ><a class="get" href="./tablebord.php">TABLEAU DE BORD</a></p></div>
                <ul>
                    <li>
                        <p class="got">Chambre</p>
                        <ul class="sous">
                            <li><a class="lien" href="./ajoutchambre.php">Ajouter</a></li>
                            <li><a class="lien" href="./listechambre.php">Liste</a></li>
                        </ul>
                    </li>
                    <li>
                        <p class="got">Suite</p>
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
                        <p class="got">Administrateurs</p>
                        <ul class="sous">
                            <li><a class="lien" href="./profil.php">Profil</a></li>
                            <li><a class="lien" href="./decon.php">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <article>
            <div><center>
                <table>
                    <caption>Réservations</caption>
                    <thead>
                        <tr>
                            <td>Numéro Réservation</td>
                            <td>Libelé</td>
                            <td>Date Début</td>
                            <td>Date Fin</td>
                            <td>Type de Chambre</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                                while ($donnees = $reponse->fetch())
                                {
                            ?> 
                            <tr>
                                <td><?php echo $donnees['num_reserv']?> </td>
                                        <td><?php echo $donnees['libel_reserv']?> </td>
                                        <td><?php echo $donnees['dat_debut']?> </td>
                                        <td><?php echo $donnees['dat_fin']?> </td>          
                                        <td><?php echo $donnees['nom_chamb  ']?> </td>                           
                            </tr>
                                <?php } ?>
                    </tbody>
                </table>
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
        }else        
        {
            header("Location:conn.php");

        }

    }
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    } 
?>