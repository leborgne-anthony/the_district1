<?php require_once "partials/header.php" ?>

<!-- Header -->
<header class="header">
    <form class="header__search">
        <input type="search" class="header__search-input" placeholder="Recherche...">
    </form>
</header>

<!-- Main -->
<main class="main">
    <section class="grid">
        <?php if (!empty($optimizedImages)): ?>
            <?php foreach ($optimizedImages as $webpImage): ?>
                <?php if (file_exists($webpImage)): ?> 
                    <article class="grid__item">
                        <picture>
                            <source srcset="<?= $webpImage ?>" type="image/webp">
                            <img src="<?= preg_replace('/\.webp$/', '.jpg', $webpImage) ?>" alt="Image optimisée" loading="lazy">
                        </picture>
                    </article>
                <?php else: ?>
                    <p>Image WebP non trouvée: <?= htmlspecialchars($webpImage) ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune image optimisée disponible.</p> 
        <?php endif; ?>
    </section>
</main>

<?php require_once "partials/footer.php" ?>
