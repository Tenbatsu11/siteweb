<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/assets/templates/header.php');
require_once(__DIR__ . '/libs/pdo.php');
require_once(__DIR__ . '/libs/getcategories.php');

$filters = [];
if (isset($_GET['category_title']) && $_GET['category_title'] != '') {
    $filters['category_title'] = $_GET['category_title'];
}
if (isset($_GET['category_description']) && $_GET['category_description'] != '') {
    $filters['category_description'] = $_GET['category_description'];
}

$categories = getCategoriesList($pdo, $filters);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Forum - Kumiai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
</head>

<body>

    <div class="row">
        <div class="col-md-2">
            <form action="" method="get">
                <h2>Filtres</h2>
                <div class="p-3 border-bottom">
                    <input type="text" name="category_title" id="category_title" class="form-control" placeholder="Rechercher" value="<?php if (isset($_GET["category_title"])) {
                                                                                                                                    echo htmlspecialchars($_GET["category_title"]);
                                                                                                                                } ?>">
                </div>
                <div class="p-3 border-bottom">
                    <input type="text" name="category_description" id="category_description" class="form-control" placeholder="Rechercher par description" value="<?php if (isset($_GET["category_description"])) {
                                                                                                                                                    echo htmlspecialchars($_GET["category_description"]);
                                                                                                                                                } ?>">
                </div>
                <div class="p-3 border-bottom">
                    <label for="JLPT">Niveau JLPT</label>
                    <select name="JLPT" id="JLPT" class="form-select">
                        <option value> -- Niveau JLPT -- </option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category["jlptlvl"] ?>" <?php if (isset($_GET["jlptlvl"]) && $category["jlptlvl"] == $_GET["jlptlvl"]) {
                                                                            echo 'selected="selected"';
                                                                        } ?>><?= $category["jlptlvl"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrer</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <main class="fade-in">
                <div class="row row-cols-1">
                    <?php foreach ($categories as $category): ?>
                        <?php require(__DIR__ . '/assets/templates/categorycard.php'); ?>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
        <?php require_once(__DIR__ . '/assets/templates/footer.php'); ?>
    </body>
</html>