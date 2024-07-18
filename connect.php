<?php
    try
    {
        $bdd=new PDO ('mysql:host=localhost;dbname=novotel', 'root', '');
    }
    catch ( exception $e )
    {
        die ('Erreur de lecture'.$e->getmessage());
    }
    
?>