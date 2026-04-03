<?php

require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');
require_once(__DIR__ . '/../../libs/getposts.php');

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}


if (isset($_GET['cid']) && isset($_GET['tid'])) {
    $cid = $_GET['cid'];
    $tid = $_GET['tid'];
    $category = getCategory($cid, $pdo);
    $topic = getTopicById($cid, $tid, $pdo);
    $post = getPost($cid, $tid, $pdo);
    $new_views = updateTopicViews($cid, $tid, $pdo);
} else {
    die('Aucun sujet spécifié.');
}
?>

<DOCTYPYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
        <link rel="stylesheet" href="/siteweb/assets/css/style.css">
    </head>

    <body>
        <?php if (isset($_SESSION['user'])) { ?>
            <input type='submit' class='btn btn-primary' value=' Ajouter une réponse '
                onclick="window.location = 'https://localhost/siteweb/assets/templates/post_reply.php?cid=<?= $cid ?>&tid=<?= $tid ?>'">
            <?php foreach ($post as $row2) { ?>
                <div class="container mt-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['topic_title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row2['post_content'])) ?></p>
                            <p class="card-text">
                                <small class="text-muted">Posté par : <?= htmlspecialchars($row2['post_creator']) ?> le <?= $row2['post_date'] ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php $oldviews = $row['topic_views'];
            $newviews = $oldviews + 1;
            ?>
        <?php } else { ?>
            <p>Vous devez être connecté pour répondre à ce sujet.</p>
        <?php } ?>
        <?php
        require_once(__DIR__ . '/../../assets/templates/footer.php');
        ?>
    </body>

    </html>