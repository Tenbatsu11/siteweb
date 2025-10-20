<?php

function getKanji($kanji_name, $pdo) {
    $pdo_prep = $pdo->prepare("SELECT * FROM kanji WHERE kanji_name = :name");
    $pdo_prep->bindValue(':name', $kanji_name);
    $pdo_prep->execute();
    return $vocab = $pdo_prep->fetch();
}