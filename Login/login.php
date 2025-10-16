<?php
require_once(__DIR__.'/../assets/templates/header.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire de connexion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
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
        <?php
        require_once (__DIR__.'/../assets/templates/footer.php');   
    ?>
    </body>
    
</html>