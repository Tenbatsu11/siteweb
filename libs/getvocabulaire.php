<?php

function getVocabulaire(PDO $pdo, array $filters = []) :array {
    $orderBy = 'word DESC';
    $conditions = [];
    $params = [];

    if (isset($filters['word'])) {
        $conditions[] = "word = :word";
        $params[':word'] = $filters['word'];
    }
    if (isset($filters['traduction'])) {
        $conditions[] = "traduction LIKE :traduction";
        $params[':traduction'] = '%' . $filters['traduction'] . '%';
    }

    $query = "SELECT * FROM vocabulaire";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $pdo_prep = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $pdo_prep->bindValue($key, $value);
    }
    $pdo_prep->execute();
    return $vocabList = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
}

function getVocabulaireByWord($word, PDO $pdo) {
    $pdo_prep = $pdo->prepare("SELECT * FROM vocabulaire WHERE word = :word");
    $pdo_prep->bindValue(':word', $word);
    $pdo_prep->execute();
    return $vocab = $pdo_prep->fetch(PDO::FETCH_ASSOC);
}