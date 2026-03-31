<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getcategories.php');

if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $cid = getCategory($cid, $pdo);
} else {
    die('Aucune catégorie spécifiée.');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kumiai Go Learn</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
    </head>
    <body>
        <main class="fade-in">
            <h1 class="d-flex align-items-center justify-content-center flex-column">Catégorie</h1>

            <div class="container d-flex align-items-center justify-content-center flex-column">
                <p>Contenu de la catégorie</p>
            </div>
            <div class="container d-flex align-items-center justify-content-center flex-column">
                <?php if ($cid) { ?>
                    <h2><?= htmlspecialchars($cid['category_title']) ?></h2>
                    <p><?= htmlspecialchars($cid['category_description']) ?></p>
                <?php } else { ?>
                    <p>Catégorie non trouvée.</p>
                    <a href="https://localhost/siteweb/forumhome.php" class="btn btn-primary">Retour au forum</a>
                <?php } ?>
        </main>
        <?php
        require_once(__DIR__ . '/../../assets/templates/footer.php');
        ?>
    </body>
</html>