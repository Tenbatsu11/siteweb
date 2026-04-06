<?php
function getPost($cid, $tid, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT p.*, u.username AS post_creator_name
        FROM posts p
        JOIN users u ON u.id = p.post_creator
        WHERE p.category_id = :category_id 
        AND p.topic_id = :topic_id 
        ORDER BY p.post_date ASC");
    $pdo_prep->bindValue(':category_id', $cid, PDO::PARAM_INT);
    $pdo_prep->bindValue(':topic_id', $tid, PDO::PARAM_INT);
    try{
    $pdo_prep->execute();
    return $topic = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur lors de la récupération des posts: ');
    }
}
?>