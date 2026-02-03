<div class="col">
    <div class="card shadow-sm">
        <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top" height="200" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg">
            <title><?= $kanji['kanji_name'] ?></title>
            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= $kanji['kanji_name'] ?></text>
        </svg>
        <div class="card-body">
            <p class="card-text"><?= ucfirst($kanji['description']) ?></p>
            <div class="mt-auto">
                <a href="/siteweb/assets/templates/kanji.php?kanji_name=<?= $kanji['kanji_name'] ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
            </div>
        </div>
    </div>
</div>