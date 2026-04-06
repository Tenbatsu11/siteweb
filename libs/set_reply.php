<?php
require_once(__DIR__ . '/pdo.php');

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

if (isset($_POST['reply_submit'])) {
    $creator = $_SESSION['user']['id'];
    $cid = (int)$_POST['cid'];
    $tid = (int)$_POST['tid'];
    $reply_content = htmlspecialchars(trim($_POST['reply_content']));
        
        $pdo_prep = $pdo->prepare("INSERT INTO posts (category_id, topic_id, post_creator,post_content, post_date) VALUES (:category_id, :topic_id, :post_creator, :post_content, now())");
        $pdo_prep->bindParam(':category_id', $cid, PDO::PARAM_INT);
        $pdo_prep->bindParam(':topic_id', $tid, PDO::PARAM_INT);
        $pdo_prep->bindParam(':post_creator', $creator, PDO::PARAM_STR);
        $pdo_prep->bindParam(':post_content', $reply_content, PDO::PARAM_STR);
        try{
            $pdo_prep->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la création de la réponse: ' );
        }

        $pdo_prep2 = $pdo->prepare("UPDATE categories SET last_post_date = now(), last_user_posted = :post_creator WHERE id = :category_id LIMIT 1");
        $pdo_prep2->bindParam(':category_id', $cid, PDO::PARAM_INT);
        $pdo_prep2->bindParam(':post_creator', $creator, PDO::PARAM_STR);

        try {
            $pdo_prep2->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour de la catégorie: ' );
        }

        $pdo_prep3 = $pdo->prepare("UPDATE topics SET topic_reply_date = now(), topic_last_user = :post_creator WHERE category_id = :category_id AND id = :tid LIMIT 1");
        $pdo_prep3->bindParam(':category_id', $cid, PDO::PARAM_INT);
        $pdo_prep3->bindParam(':tid', $tid, PDO::PARAM_INT);
        $pdo_prep3->bindParam(':post_creator', $creator, PDO::PARAM_STR);
        try {
            $pdo_prep3->execute();
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour du sujet: ' );
        }
        //Envoie d'email

        if (($pdo_prep) && ($pdo_prep2) && ($pdo_prep3)) {
            header('Location: https://localhost/siteweb/assets/templates/topic.php?cid=' . $cid . '&tid=' . $tid);
            exit();
        } else {
            die('Erreur lors de la création de la réponse.');
        }
} else {
    die('Requête invalide.');
}