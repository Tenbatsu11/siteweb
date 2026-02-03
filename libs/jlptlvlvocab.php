<?php 
function getJLPTLevels(PDO $pdo) {
    $pdo_prep = $pdo->prepare("SELECT DISTINCT jlptlvl FROM vocabulaire ORDER BY jlptlvl ASC");
    $pdo_prep->execute();
    return $categories = $pdo_prep->fetchAll(PDO::FETCH_ASSOC);
}
?>