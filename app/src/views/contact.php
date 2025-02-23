<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php require_once "partials/header.php" ?>
    
    <!-- Header -->
    <header class="header">
        <form class="header__search">
            <input type="search" class="header__search-input" placeholder="Recherche...">
        </form>
    </header>

    <?php if (!empty($_SESSION['success'])): ?>
        <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <!-- Main -->
    <main class="main">
    <form action="/contact-submit" method="POST" class="contact-form">
        <div class="form-row">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
            </div>
        </div>

        <div class="form-group form-group--full">
            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>
        </div>

        <button type="submit" class="button button--primary">Envoyer</button>
    </form>
</main>


<?php require_once "partials/footer.php" ?>


