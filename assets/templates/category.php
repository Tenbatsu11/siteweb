<?php
require_once(__DIR__ . '/../../libs/pdo.php');

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/../../assets/templates/header.php');
require_once(__DIR__ . '/../../libs/getcategories.php');
require_once(__DIR__ . '/../../libs/gettopic.php');

if (isset($_GET['cid'])) {
    $id = $_GET['cid'];
    $cid = getCategory($id, $pdo);
    $cid2 = getTopic($id, $pdo);
} else {
    die('Aucune catégorie spécifiée.');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Kumiai Go Learn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
</head>

<body>
    <main class="fade-in">
        <h1 class="d-flex align-items-center justify-content-center flex-column">Catégorie</h1>

        <div class="container d-flex align-items-center justify-content-center flex-column mb-4">
            <p>Contenu de la catégorie</p>
        </div>
        <div class="container d-flex align-items-center justify-content-center flex-column">
            <?php if ($cid) { ?>
                <h2><?= $cid['category_title'] ?></h2>
                <p><?= $cid['category_description'] ?></p>

                <div class="container row-cols-2 mb-3 g-3">
                    <a href="https://localhost/siteweb/forumhome.php" class="btn btn-primary">Retour au forum</a>
                </div>
                <div class="container row-cols-2 mb-3 g-3">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="https://localhost/siteweb/assets/templates/create_topic.php?cid=<?= $cid['id'] ?>" class="btn btn-primary">Créer un sujet</a>
                    <?php } ?>
                </div>
                <?php if (!empty($cid2)) { ?>
                    <?php foreach ($cid2 as $row) { ?>
                        <div class="topic-item mb-3 p-3 border rounded w-100">
                            <a href="https://localhost/siteweb/assets/templates/topic.php?cid=<?= $cid['id'] ?>&tid=<?= $row['id'] ?>">
                                <?= htmlspecialchars($row['topic_title']) ?>
                            </a><br />
                            <span class="post-info">
                                Posté par : <?= htmlspecialchars($row['topic_creator']) ?>
                                le <?= $row['topic_date'] ?> |
                                Vues : <?= $row['topic_views'] ?>
                            </span>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>Aucun sujet disponible pour cette catégorie.</p>
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a href="https://localhost/siteweb/assets/templates/create_topic.php?cid=<?= $cid['id'] ?>" class="btn btn-primary">Créer un sujet</a>
                    <?php } else { ?>
                        <p>Connectez-vous pour créer un sujet.</p>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <p>Catégorie non trouvée.</p>
                <a href="https://localhost/siteweb/forumhome.php" class="btn btn-primary">Retour au forum</a>
            <?php } ?>
        </div>
    </main>
    <?php
    require_once(__DIR__ . '/../../assets/templates/footer.php');
    ?>
</body>

</html>