<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

// Accept either post_id or tid (topic id). If tid provided, resolve to the first post of the topic.
if (!isset($_GET['post_id']) && !isset($_GET['tid'])) {
    die('Aucun post spécifié.');
}

require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');

$user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
} else {
    $tid = (int)$_GET['tid'];
    // find the first post for this topic
    $stmt = $pdo->prepare('SELECT id FROM posts WHERE topic_id = :tid ORDER BY post_date ASC LIMIT 1');
    $stmt->bindParam(':tid', $tid, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row && isset($row['id'])) {
        $post_id = (int)$row['id'];
    } else {
        die('Aucun post trouvé pour ce sujet.');
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Signaler un post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Signaler le post #<?= htmlspecialchars($post_id) ?></h5>
            <form action="/siteweb/libs/set_signalement.php" method="post">
                <input type="hidden" name="post_id" value="<?= htmlspecialchars($post_id) ?>">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

                <div class="mb-3">
                    <label for="comm" class="form-label">Commentaire (optionnel)</label>
                    <textarea name="comm" id="comm" class="form-control" rows="4" maxlength="1000"></textarea>
                </div>

                <button type="submit" name="signal_submit" value="1" class="btn btn-danger">Envoyer le signalement</button>
                <a href="/siteweb/assets/templates/topic.php" class="btn btn-secondary ms-2">Annuler</a>
            </form>
        </div>
    </div>
</main>

<?php require_once(__DIR__ . '/../../assets/templates/footer.php'); ?>
</body>
</html>
