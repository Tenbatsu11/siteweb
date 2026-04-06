<?php
require_once(__DIR__ . '/../assets/templates/header.php');
require_once(__DIR__ . '/../libs/pdo.php');
require_once(__DIR__ . '/../libs/user.php');

if ($_SERVER['REQUEST_METHOD']  === 'POST') {
    $user = verifyUserLogin($_POST['username'], $_POST['password'], $pdo);
    if ($user) {
        session_regenerate_id(true);
        $_SESSION["user"] = [
            "id" => $user['id'],
            "username" => $user['username'],
            "email" => $user['email'],
            "user_lvl" => $user['user_lvl'],
            "abonnement" => $user['abonnement']
        ];
        header('Location: https://localhost/siteweb/index.php');
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect !";
    }
}
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
    <main class="form-signin w-100 m-auto fade-in">
        <div class="container">
            <a href="https://kumiai.sukai.moe/fr/">
                <img width="328" src="/siteweb/assets/images/logo-kumiai.png" alt="Kumiai">
            </a>
        </div>
        <h1>Formulaire de connexion</h1>
        <form action="" method="Post" class="form fade-in">
            <label for="username">Nom d'utilisateur:</label>
            <div class="form-floating">
                <input type="text" id="username" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur">
                <br><br>
            </div>
            <label for="password" id="password">Mot de passe:</label>
            <div class="form-floating">
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe">
                <br><br>
            </div>
            <input type="submit" value="Se connecter">
        </form>
        <p>Pas déjà inscrit ? <a href="https://localhost/siteweb/register/registerpage.php">Inscrivez vous!</a>
    </main>
    <?php
    require_once(__DIR__ . '/../assets/templates/footer.php');
    ?>
</body>

</html>