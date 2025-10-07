<?php
require_once(__DIR__.'/../assets/templates/header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire de connexion</title>
    </head>
    <body>
        <main class="fade-in">
            <div class ="container">
                <a href="https://kumiai.sukai.moe/fr/">
                    <img width="1028" src="/siteweb/assets/images/logo-kumiai.png" alt="Kumiai">
                </a>
            </div>        
        <h1>Formulaire de connexion</h1>
            <form action="faille.php" method="Post" class="form fade-in">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username">
                <br><br>
                <label for="password" id="password">Mot de passe:</label>
                <input type="password" id="password" name="password">
                <br><br>
                <input type="submit" value="Se connecter">
            </form>
            <p>Pas déjà inscrit ? <a href="https://localhost/siteweb/register/registerpage.php">Inscrivez vous!</a>
        </main>
    </body>
</html>