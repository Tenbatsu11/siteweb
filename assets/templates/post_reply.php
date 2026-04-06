<?php
require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');

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
} else {
    die('Aucun sujet spécifié.');
}

?>


<!DOCTYPE html>
    <html>
    <header>
        <meta charset="UTF-8">
        <title>Kumiai Go Learn</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
    </header>
    <main class="fade-in">
        <form action="/siteweb/libs/set_reply.php" method="post" class="container d-flex align-items-center justify-content-center flex-column">
            <h1>Répondre au sujet:</h1>
            <h2><?= $topic['topic_title'] ?></h2>
            <div class="mb-3 w-100">
                <label for="reply_content" class="form-label">Contenu de la réponse</label>
                <textarea class="form-control" id="reply_content" name="reply_content" rows="5" cols="75" required></textarea>
            </div>
            <input type="hidden" name="cid" value="<?= $cid ?>">
            <input type="hidden" name="tid" value="<?= $tid ?>">

            <button type="submit" name="reply_submit" class="btn btn-primary">Poster la réponse</button>
        </form>

    </main>
    <?php
    require_once(__DIR__ . '/../../assets/templates/footer.php');
    ?>
    </body>

    </html>