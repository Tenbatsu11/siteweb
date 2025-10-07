<?php
    require_once (__DIR__.'/../assets/templates/header.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire d'inscription</title>
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
        <h1>Formulaire d'inscription</h1>
            <form action="register.php" method="Post" class="form fade-in">
                <label for="username">Nom d'utilisateur:</label>
                <br>
                <input type="text" id="username" name="username" required>
                <br><br>
                <laber for="email">Adresse Email :</label>
                <br>
                <input type="text" id="email" name="email" required>
                <br><br>
                <label for="password" id="password">Mot de passe:</label>
                <br>
                <input type="password" id="password" name="password"required>
                <br><br>
                <label for="cofirm_password">Confirmer le mot de passe :</label>
                <input type="password" name="confirm_password" required>
                <br><br>
                <input type="submit" value="S'inscrire">
            </form>
            <p>Déjà inscrit ? <a href="https://localhost/siteweb/Login/login.php">Connectez vous !</a></p>
        </main>
    </body>
</html>