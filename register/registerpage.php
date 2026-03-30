<?php
require_once(__DIR__ . '/../assets/templates/header.php');
require_once(__DIR__ . '/../libs/pdo.php');
require_once(__DIR__ . '/../libs/user.php');

if ($_SERVER['REQUEST_METHOD']  === 'POST') {
    $verif = verifyUser($_POST, $pdo);
    if ($verif === true) {
        $resAdd = addUser(
            htmlspecialchars(trim($_POST['username'])),
            htmlspecialchars(trim($_POST['email'])),
            $_POST['password'],
            $pdo
        );
        header('Location: index.php');
    } else {
        $error = $verif;
    }
}

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
    <main class="form-signin w-100 m-auto fade-in">
        <div class="container">
            <a href="https://kumiai.sukai.moe/fr/">
                <img width="328" src="/siteweb/assets/images/logo-kumiai.png" alt="Kumiai">
            </a>
        </div>
        <h1>Formulaire d'inscription</h1>
        <form action="" method="Post" class="form fade-in">
            <label for="username" id="username">Nom d'utilisateur:</label>
            <div class="form-floating">
                <input type="text" id="username" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur" required>
                <?php if (isset($error['username'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error['username']; ?>
                    </div>
                <?php } ?>
                <br><br>
            </div>
            <label for="email" id="email">Adresse email:</label>
            <div class="form-floating">
                <input type="text" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email" required>
                <?php if (isset($error['email'])) { ?>
                    <div class="alert alert-danger" role="alert">
                            <?= $error['email']; ?>
                        </div>
                    <?php } ?>
                    <br><br>
            </div>
            <label for="password" id="password">Mot de passe:</label>
            <div class="form-floating">
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" required>
                <?php if (isset($error['password'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error['password']; ?>
                    </div>
                <?php } ?>
                <br><br>
            </div>
            <label for="confirm_password" id="confirm_password">Confirmez votre mot de passe:</label>
            <div class="form-floating">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirmez votre mot de passe" required>
                <?php if (isset($error['confirm_password'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error['confirm_password']; ?>
                    </div>
                <?php } ?>
                <br><br>
            </div>
            <input type="submit" value="S'inscrire">
        </form>
        <p>Déjà inscrit ? <a href="https://localhost/siteweb/Login/login.php">Connectez vous !</a></p>
    </main>
    <?php
    require_once(__DIR__ . '/../assets/templates/footer.php');
    ?>
</body>

</html>