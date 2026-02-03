<?php
require_once(__DIR__ . '/../../libs/pdo.php');
require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getvocabulaire.php');

if (isset($_GET['word'])) {
    $word = $_GET['word'];
    $vocab = getVocabulaireByWord($word, $pdo);
} else {
    die('Aucun mot de vocabulaire spécifié.');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $vocab['word'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
</head>

<body>
    <main class="fade-in">
        <h1 class="d-flex align-items-center justify-content-center flex-column">Le mot de vocabulaire <ruby><?= htmlspecialchars($vocab['word']) ?> <rt><?= $vocab['furigana'] ?></rt></ruby></h1>

        <div class="container d-flex align-items-center justify-content-center flex-column">
            <p><strong>Il se compose des kanjis suivants :</strong></p>
            <?php
            $chars = mb_str_split($vocab['word']);
            foreach ($chars as $char) {
                echo '<a href="kanji.php?kanji_name=' . urlencode($char) . '">' . htmlspecialchars($char) . '</a>';
            }
            ?>

        </div>
        <br>

        <div class="section d-flex align-items-center justify-content-center flex-column">
            <h2>Traduction</h2>
            <p><?= $vocab['traduction'] ?></p>
        </div>

    </main>
    <?php
    require_once(__DIR__ . '/../../assets/templates/footer.php');
    ?>
</body>

</html>