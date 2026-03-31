<?php
function getTopic($topic_id, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT * FROM topics WHERE category_id = :id ORDER BY topic_reply_date DESC");
    $pdo_prep->bindValue(':id', $topic_id, PDO::PARAM_INT);
    $pdo_prep->execute();
    return $topic = $pdo_prep->fetch(PDO::FETCH_ASSOC);
}