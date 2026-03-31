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

function getCategory($id, PDO $pdo)
{
    $pdo_prep = $pdo->prepare("SELECT id, category_title, category_description FROM categories WHERE id = :id LIMIT 1");
    $pdo_prep->bindValue(':id', $id, PDO::PARAM_INT);
    $pdo_prep->execute();
    return $category = $pdo_prep->fetch(PDO::FETCH_ASSOC);
}
?>