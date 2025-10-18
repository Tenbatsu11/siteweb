<?php

require_once(__DIR__ . '/assets/templates/header.php');
require_once(__DIR__ . '/libs/pdo.php');
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
    <main class="fade-in">
        <div class="container">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm"> <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top" height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Vocabulaire</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">Description du mot de vocabulaire avec fetch pdo</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group"> <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm"> <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top" height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Vocabulaire</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">Description du mot de vocabulaire avec fetch pdo</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group"> <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    require_once(__DIR__ . '/assets/templates/footer.php');
    ?>
</body>

</html>