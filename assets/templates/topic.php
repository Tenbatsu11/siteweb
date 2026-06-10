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
                            <h5 class="card-title"><?= htmlspecialchars($topic['topic_title']) ?></h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars($row2['post_content'])) ?></p>
                            <p class="card-text">
                                <small class="text-muted">Posté par : <?= htmlspecialchars($row2['post_creator_name']) ?> le <?= $row2['post_date'] ?></small>
                            </p>
                            <div class="container d-flex align-items-center justify-content-center flex-column mb-4">
                                <a class="btn btn-danger justify-content-center" href="/siteweb/assets/templates/post_signalement.php?post_id=<?= urlencode($row2['id']) ?>&cid=<?= urlencode($cid) ?>&tid=<?= urlencode($tid) ?>">Signaler le post</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="container d-flex align-items-center justify-content-center flex-column mb-4">
                <a class="btn btn-primary justify-content-center" href="/siteweb/assets/templates/post_reply.php?cid=<?= urlencode($cid) ?>&tid=<?= urlencode($tid) ?>">Ajouter une réponse</a>
            </div>


            <?php // views already updated via updateTopicViews(); ?>
        <?php } else { ?>
            <p>Vous devez être connecté pour répondre à ce sujet.</p>
        <?php } ?>
        <?php
        require_once(__DIR__ . '/../../assets/templates/footer.php');
        ?>
</body>

</html>