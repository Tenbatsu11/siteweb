<?php
session_start();

require_once(__DIR__ . '/assets/templates/header.php');
require_once(__DIR__ . '/libs/pdo.php');
require_once(__DIR__ . '/libs/getkanji.php');
require_once(__DIR__ . '/libs/jlptlvlkanji.php');

$filters = [];
if (isset($_GET['kanji_name']) && $_GET['kanji_name'] != '') {
    $filters['kanji_name'] = $_GET['kanji_name'];
}
if (isset($_GET['description']) && $_GET['description'] != '') {
    $filters['description'] = $_GET['description'];
}

$kanjiList = getKanjiList($pdo, $filters);
$categories = getJLPTLevels($pdo);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kanji - Home</title>
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
                    <input type="text" name="kanji_name" id="kanji_name" class="form-control" placeholder="Rechercher" value="<?php if (isset($_GET["kanji_name"])) {
                                                                                                                                    echo htmlspecialchars($_GET["kanji_name"]);
                                                                                                                                } ?>">
                </div>
                <div class="p-3 border-bottom">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Rechercher par description" value="<?php if (isset($_GET["description"])) {
                                                                                                                                                    echo htmlspecialchars($_GET["description"]);
                                                                                                                                                } ?>">
                </div>
                <div class="p-3 border-bottom">
                    <label for="jlptlvl">Niveau JLPT</label>
                    <select name="jlptlvl" id="jlptlvl" class="form-select">
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
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <div class="container" style="background-color: #f8d7da; color: #721c24; padding: 20px; border-radius: 5px; margin-top: 20px;">
                            <p><strong>Consultez tous les kanjis et leurs détails en vous connectant ou en créant un compte !</strong></p>
                            <p>Pour pouvoir accéder à tous les kanjis et leurs détails, veuillez vous connecter ou créer un compte.
                                <a href="https://localhost/siteweb/Login/login.php" class="alert-link">Se connecter / S'inscrire</a>.
                            </p>
                        </div>
                    <?php } else {
                        foreach ($kanjiList as $key => $kanji) {
                            require(__DIR__ . '/assets/templates/kanjicard.php');
                        }
                    } ?>
                </div>
            </main>
        </div>
    </div>
    <?php
    require_once(__DIR__ . '/assets/templates/footer.php');
    ?>
</body>

</html>