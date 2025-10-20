<?php
require_once (__DIR__.'/../../libs/pdo.php');
require_once (__DIR__.'/../../assets/templates/header.php');
require_once (__DIR__.'/../../libs/getkanji.php');


if (isset ($_GET['kanji_name'])) {
    $kanji_name = $_GET['kanji_name'];
    $kanji = getKanji($kanji_name, $pdo);
} else {    
    die ('Aucun kanji spécifié.');
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $kanji['kanji_name']?></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
</head>
    <body>
        <main class="fade-in">
            <h1>Le kanji <ruby><?= htmlspecialchars($kanji['kanji_name'])?> 
            <rt><?= (trim(explode(',', $kanji['kunyomi'])[0]))?></rt></ruby></h1>

            <div class="kanji"><?= $kanji['kanji_name']?> </div>

            <div class="section">
                <h2>Signification</h2>
                <p><?= $kanji['description']?></p>
            </div>

            <div class="section">
                <h2>Lectures</h2>
                <ul>
                    <li>(lecture kunyomi) : <?= $kanji['kunyomi']?></li>
                    <li>(lecture onyomi) : <?= $kanji['onyomi']?> </li>
                </ul>
            </div>
        </main>
        <?php
        require_once (__DIR__.'/../../assets/templates/footer.php');   
    ?>
    </body>
</html>