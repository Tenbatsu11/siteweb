<?php
session_start();

require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');
require_once(__DIR__ . '/../../libs/getposts.php');


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

<!DOCTYPE html>

<body>
    <main class="fade-in">
        <div class="container d-flex align-items-center justify-content-center flex-column mb-4">
            <h1><?= htmlspecialchars($topic['topic_title']) ?></h1>
            <p>Posté par : <strong><?= htmlspecialchars($topic['topic_creator_name']) ?></strong> le <?= $topic['topic_date'] ?> | Vues : <?= $topic['topic_views'] ?></p>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <?php foreach ($post as $row2) { ?>
                <div class="container mt-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['topic_title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row2['post_content'])) ?></p>
                            <p class="card-text">
                                <small class="text-muted">Posté par : <?= htmlspecialchars($row2['post_creator_name']) ?> le <?= $row2['post_date'] ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="container d-flex align-items-center justify-content-center flex-column mb-4">
                <input type='submit' class='btn btn-primary justify-content-center' value=' Ajouter une réponse '
                    onclick="window.location = 'https://localhost/siteweb/assets/templates/post_reply.php?cid=<?= $cid ?>&tid=<?= $tid ?>'">
            </div>


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