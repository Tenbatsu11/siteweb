<?php
function getCategoriesList(PDO $pdo, array $filters = []): array
{
    $orderBy = 'category_title ASC';
    $conditions = [];
    $params = [];

    if (isset($filters['category_title'])) {
        $conditions[] = "category_title LIKE :category_title";
        $params[':category_title'] = '%' . $filters['category_title'] . '%';
    }

    if (isset($filters['category_description'])) {
        $conditions[] = "category_description LIKE :category_description";
        $params[':category_description'] = '%' . $filters['category_description'] . '%';
    }

    $query = "SELECT * FROM categories";
    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $pdo_prep = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $pdo_prep->bindValue($key, $value);
    }
    $pdo_prep->execute();
    return $categoriesList = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
}
?>