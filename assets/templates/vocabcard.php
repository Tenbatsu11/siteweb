<div class="col">
                        <div class="card shadow-sm"> 
                            <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img card-img-top" height="225" preserveAspectRatio="xMidYMid slice" role="img" width="100%" xmlns="http://www.w3.org/2000/svg">
                                <title><?= $vocab["word"] ?></title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= $vocab["word"] ?></text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text"><?= $vocab["traduction"] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="/siteweb/assets/templates/vocabulaire.php?word=<?= $vocab["word"] ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>