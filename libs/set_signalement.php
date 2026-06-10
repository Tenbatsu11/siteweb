<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

if (!isset($_POST['signal_submit'])) {
    die('Aucune donnée reçue.');
}

require_once(__DIR__ . '/pdo.php');

$post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : null;
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null; // keep as string if UUID
$comm = isset($_POST['comm']) ? trim($_POST['comm']) : '';

if (!$post_id || !$user_id) {
    die('Données manquantes.');
}

try {
    $pdo_prep = $pdo->prepare("INSERT INTO signalement (id_user, id_post, comm, date_signal) VALUES (:id_user, :id_post, :comm, now())");
    $pdo_prep->bindParam(':id_user', $user_id, PDO::PARAM_STR);
    $pdo_prep->bindParam(':id_post', $post_id, PDO::PARAM_INT);
    $pdo_prep->bindParam(':comm', $comm, PDO::PARAM_STR);
    $pdo_prep->execute();

    // Redirect back to topic page (attempt to find topic id via posts table)
    $findTopic = $pdo->prepare('SELECT topic_id FROM posts WHERE id = :post_id LIMIT 1');
    $findTopic->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $findTopic->execute();
    $row = $findTopic->fetch(PDO::FETCH_ASSOC);
    $topicId = $row ? $row['topic_id'] : null;

    if ($topicId) {
        header('Location: https://localhost/siteweb/assets/templates/topic.php?id=' . $topicId . '&tid=' . $topicId);
    } else {
        header('Location: https://localhost/siteweb/kanjihome.php');
    }
    exit();
} catch (PDOException $e) {
    die('Erreur lors de l\'enregistrement du signalement: ' . $e->getMessage());
}
