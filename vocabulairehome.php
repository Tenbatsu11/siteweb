<?php

require_once(__DIR__ . '/assets/templates/header.php');
require_once(__DIR__ . '/libs/pdo.php');
require_once(__DIR__ . '/libs/getvocabulaire.php');
require_once(__DIR__ . '/libs/jlptlvlvocab.php');

$filters = [];
if (isset($_GET['word']) && $_GET['word'] != '') {
    $filters['word'] = $_GET['word'];
}
if (isset($_GET['traduction']) && $_GET['traduction'] != '') {
    $filters['traduction'] = $_GET['traduction'];
}

$vocab = getVocabulaire($pdo, $filters);
$categories = getJLPTLevels($pdo);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vocabulaire - Home</title>
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
                <input type="text" name="word" id="word" class="form-control" placeholder="Rechercher" value="<?php if (isset($_GET["word"])) {
                                                                                                                        echo htmlspecialchars($_GET["word"]);
                                                                                                                    } ?>">
            </div>
            <div class="p-3 border-bottom">
                <input type="text" name="traduction" id="traduction" class="form-control" placeholder="Rechercher par traduction" value="<?php if (isset($_GET["traduction"])) {
                                                                                                                        echo htmlspecialchars($_GET["traduction"]);
                                                                                                                    } ?>">
            </div>
            <div class="p-3 border-bottom">
                <label for="JLPT">Niveau JLTP</label>
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($vocab as $key => $vocab): ?>
                <?php
                    require(__DIR__ . '/assets/templates/vocabcard.php');
                ?>
                <?php endforeach; ?>                
            </div>
        </main>
    </div>
</div>
    <?php
    require_once(__DIR__ . '/assets/templates/footer.php');
    ?>
</body>

</html>