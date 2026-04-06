<?php

session_start();
if ((!isset($_SESSION['user'])) || !isset($_GET['cid'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');


if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
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
        <form action="/siteweb/libs/set_topic.php" method="post" class="container d-flex align-items-center justify-content-center flex-column">
            <h1>Créer un sujet dans la catégorie :</h1>
                <h2><?= $cid['category_title'] ?></h2>
            <div class="mb-3 w-100">
                <label for="topic_title" class="form-label">Titre du sujet</label>
                <input type="text" class="form-control" id="topic_title" name="topic_title" required>
            </div>
            <div class="mb-3 w-100">
                <label for="topic_content" class="form-label">Contenu du sujet</label>
                <textarea class="form-control" id="topic_content" name="topic_content" rows="5" cols="75" required></textarea>
            </div>
            <input type="hidden" name="cid" value="<?= $cid['id'] ?>">

            <button type="submit" name="topic_submit" class="btn btn-primary">Créer le sujet</button>
        </form>
    </main>
    <?php
    require_once(__DIR__ . '/../../assets/templates/footer.php');
    ?>
</body>

</html>