<?php

function getVocabulaire($word, $pdo) {
    $pdo_prep = $pdo->prepare("SELECT * FROM vocabulaire WHERE word = :word");
    $pdo_prep->bindValue(':word', $word);
    $pdo_prep->execute();
    return $kanji = $pdo_prep->fetch();
}