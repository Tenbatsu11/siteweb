<div class="col">
    <div class="card h-100 shadow-sm">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($category['category_title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($category['category_description']) ?></p>
            <a href="/siteweb/assets/templates/category.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
        </div>
    </div>
</div>