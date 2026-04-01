<?php
function getTopic($tid, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT * FROM topics WHERE category_id = :category_id ORDER BY topic_reply_date DESC");
    $pdo_prep->bindValue(':category_id', $tid, PDO::PARAM_INT);
    $pdo_prep->execute();
    return $topic = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
}

function getTopicById($cid, $tid, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT * FROM topics WHERE category_id = :category_id AND id = :id LIMIT 1");
    $pdo_prep->bindValue(':category_id', $cid, PDO::PARAM_INT);
    $pdo_prep->bindValue(':id', $tid, PDO::PARAM_INT);
    $pdo_prep->execute();
    return $topic = $pdo_prep->fetch(PDO::FETCH_ASSOC);
}