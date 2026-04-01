<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}


if (isset($_POST['topic_submit'])) {
    if(($_POST['topic_title'] != '') && ($_POST['topic_content'] != '')) {

        require_once(__DIR__ . '/pdo.php');
        
        $cid = (int)$_POST['cid'];
        $title = $_POST['topic_title'];
        $content = $_POST['topic_content'];
        $creator = $_SESSION['user']['id'];
        
        $pdo_prep = $pdo->prepare("INSERT INTO topics (category_id, topic_title, topic_creator, topic_date, topic_reply_date) VALUES (:category_id, :topic_title, :topic_creator, now(),now())");
        $pdo_prep->bindParam(':category_id', $cid, PDO::PARAM_INT);
        $pdo_prep->bindParam(':topic_title', $title, PDO::PARAM_STR);
        $pdo_prep->bindParam(':topic_creator', $creator, PDO::PARAM_STR);

        try {
        $pdo_prep->execute();
        $newTopicId = (int)$pdo->lastInsertId();
        var_dump($newTopicId);
        } catch (PDOException $e) {
            die('Erreur lors de la création du sujet: ' . $e->getMessage());
        }

        var_dump($newTopicId);

        $pdo_prep2 = $pdo->prepare("INSERT INTO posts (category_id, topic_id, post_creator,post_content, post_date) VALUES (:category_id, :topic_id, :post_creator, :post_content, now())");
        $pdo_prep2->bindParam(':category_id', $cid, PDO::PARAM_INT);
        $pdo_prep2->bindParam(':topic_id', $newTopicId, PDO::PARAM_INT);
        $pdo_prep2->bindParam(':post_creator', $creator, PDO::PARAM_STR);
        $pdo_prep2->bindParam(':post_content', $content, PDO::PARAM_STR);

        try {
            $pdo_prep2->execute() or die('Erreur lors de la création du post initial du sujet.');
        } catch (PDOException $e) {
            die('Erreur lors de la création du post initial du sujet: ' . $e->getMessage());
        }
    }

        $pdo_prep3 = $pdo->prepare("UPDATE categories SET last_post_date = now(), last_user_posted = :creator WHERE id = :category_id LIMIT 1");
        $pdo_prep3->bindParam(':creator', $creator, PDO::PARAM_STR);
        $pdo_prep3->bindParam(':category_id', $cid, PDO::PARAM_INT);

        try{
            $pdo_prep3->execute() or die('Erreur lors de la mise à jour de la catégorie.');
        } catch (PDOException $e) {
            die('Erreur lors de la mise à jour de la catégorie: ' . $e->getMessage());
        }

        if (($pdo_prep) && ($pdo_prep2) && ($pdo_prep3)) {
            header('Location: https://localhost/siteweb/assets/templates/topic.php?id=' . $cid . '&tid=' . $newTopicId);
            exit();
        } else {
            die('Erreur lors de la création du sujet. Veuillez réessayer.');
        }
    } else {
        die('Veuillez remplir tous les champs.');
    }