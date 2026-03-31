<?php

function getKanjiList(PDO $pdo, array $filters = []): array
{
    $orderBy = 'kanji_name DESC';
    $conditions = [];
    $params = [];

    if (isset($filters['kanji_name'])) {
        $conditions[] = "kanji_name = :kanji_name";
        $params[':kanji_name'] = $filters['kanji_name'];
    }

    if (isset($filters['description'])) {
        $conditions[] = "description LIKE :description";
        $params[':description'] = '%' . $filters['description'] . '%';
    }

    $query = "SELECT * FROM kanji";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $pdo_prep = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $pdo_prep->bindValue($key, $value);
    }
    $pdo_prep->execute();
    return $kanjiList = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
}

function getKanji($kanji_name, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT kanji_name, description, onyomi, kunyomi FROM kanji WHERE kanji_name = :kanji_name LIMIT 1");
    $pdo_prep->bindValue(':kanji_name', $kanji_name);
    $pdo_prep->execute();
    return $kanji = $pdo_prep->fetch(PDO::FETCH_ASSOC);
}
